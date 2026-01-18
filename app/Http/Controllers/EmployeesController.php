<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\str_slug;

class EmployeesController extends Controller
{
    public function index(Request $request) 
    {
        $query = Employee::with('department');
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $searchParts = explode(' ', trim($searchTerm));
            
            $query->where(function($q) use ($searchParts) {
                foreach ($searchParts as $part) {
                    $part = trim($part);
                    if (!empty($part)) {
                        $q->orWhere('first_name', 'like', "%{$part}%")
                          ->orWhere('last_name', 'like', "%{$part}%")
                          ->orWhere('email', 'like', "%{$part}%")
                          ->orWhere('phone', 'like', "%{$part}%")
                          ->orWhere('position', 'like', "%{$part}%")
                          ->orWhere('salary', 'like', "%{$part}%")
                          ->orWhere('department_id', 'like', "%{$part}%");
                    }
                }
            });
        }

        if ($request->filled('department_filter') && $request->department_filter != '') {
            $query->where('department_id', $request->department_filter);
        }

        $employees = $query->get();
        $departments = Department::all();

        return view('dashboard', compact('employees', 'departments')); 
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees_tbl',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'department_id' => 'nullable|exists:departments_tbl,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('employee_photos', 'public');
            $validated['photo'] = $photoPath;
        }

        Employee::create($validated); 
        return redirect()->back()->with('success', 'Employee added successfully.'); 
    }

    public function update(Request $request, Employee $employee) 
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees_tbl,email,' . $employee->id,
            'phone' => 'nullable|string|max:20',
            'position' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'department_id' => 'nullable|exists:departments_tbl,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }

            $photoPath = $request->file('photo')->store('employee_photos', 'public');
            $validated['photo'] = $photoPath;
        }

        $employee->update($validated); 
        return redirect()->back()->with('success', 'Employee updated successfully.');
    }

    public function edit(Employee $employee)
    {
        return response()->json([
            'id' => $employee->id,
            'first_name' => $employee->first_name,
            'last_name' => $employee->last_name,
            'email' => $employee->email,
            'phone' => $employee->phone,
            'position' => $employee->position,
            'salary' => $employee->salary,
            'department_id' => $employee->department_id,
            'photo' => $employee->photo,
            'photo_url' => $employee->photo ? Storage::disk('public')->url($employee->photo) : null,
            
        ]);
    }

    public function destroy(Employee $employee) 
    {
        $employee->delete(); 
        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }

    public function trash()
    {
        $employees = Employee::onlyTrashed()->with('department')->latest('deleted_at')->get();
        $departments = Department::all();

        return view('trash', compact('employees', 'departments'));
    }

    public function restore($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('employees.index')->with('success', 'Employees restored successfully');
    }

    public function forceDelete($id)
    {
        $employee = Employee::withTrashed()->findOrFail($id);

        if ($employee->photo) {
            Storage::disk('public')->delete($employee->photo);
        }

        $employee->forceDelete();
        return redirect()->route('employees.trash')->with('success', 'Permanently deleted!');
    }

    public function exportPDF(Request $request)
    {
        $query = Employee::with('department');

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $searchParts = explode(' ', trim($searchTerm));
            
            $query->where(function($q) use ($searchParts) {
                foreach ($searchParts as $part) {
                    $part = trim($part);
                    if (!empty($part)) {
                        $q->orWhere('first_name', 'like', "%{$part}%")
                          ->orWhere('last_name', 'like', "%{$part}%")
                          ->orWhere('email', 'like', "%{$part}%")
                          ->orWhere('phone', 'like', "%{$part}%")
                          ->orWhere('position', 'like', "%{$part}%")
                          ->orWhere('salary', 'like', "%{$part}%")
                          ->orWhere('department_id', 'like', "%{$part}%");
                    }
                }
            });
        }

        if ($request->filled('department_filter') && $request->department_filter != '') {
            $query->where('department_id', $request->department_filter);
        }

        $employees = $query->latest()->get();
        
        $searchTerm = $request->search ?: 'All';
        $deptName = $request->department ?: 'All';
        $filename = "Employee_Report{$searchTerm}{$deptName}_" . now()->format('Ymd_His') . ".pdf";

        // Convert to absolute paths for dompdf
        $employees = $employees->map(function($employee) {
            if ($employee->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($employee->photo)) {
                $employee->photo_path = storage_path('app/public/' . $employee->photo);
            } else {
                $employee->photo_path = null;
            }
            return $employee;
        });

        $pdf = \Pdf::loadView('pdfexport', compact('employees'));
        return $pdf->download($filename);
    }
}