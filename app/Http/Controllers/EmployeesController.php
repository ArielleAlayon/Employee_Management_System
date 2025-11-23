<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index() 
    {
        $employees = Employee::with('department')->oldest()->get();
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
            'position' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'department_id' => 'nullable|exists:departments_tbl,id',
        ]); 

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
        ]); 

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
            
        ]);
    }

    public function destroy(Employee $employee) 
    {
        $employee->delete(); 
        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}