<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index() 
    {
        $departments = Department::withCount('employees')->oldest()->get();
        return view('departments', compact('departments')); 
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'dept_name' => 'required|string|max:255|unique:departments_tbl',
            'description' => 'nullable|string|max:1000',
        ]); 

        Department::create($validated); 
        return redirect()->back()->with('success', 'Department added successfully.'); 
    }

    public function update(Request $request, Department $department) 
    {
        $validated = $request->validate([
            'dept_name' => 'required|string|max:255|unique:departments_tbl,dept_name,' . $department->id,
            'description' => 'nullable|string|max:1000',
        ]); 

        $department->update($validated); 
        return redirect()->back()->with('success', 'Department updated successfully.');
    }

    public function edit(Department $department)
    {
        return response()->json([
            'id' => $department->id,
            'dept_name' => $department->dept_name,
            'description' => $department->description,
        ]);
    }

    public function destroy(Department $department) 
    {
        // Check if department has employees before deleting
        if ($department->employees()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete department that has employees.');
        }

        $department->delete(); 
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }
}