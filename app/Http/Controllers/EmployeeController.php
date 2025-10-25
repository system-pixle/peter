<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
            $employees = Employee::all(); // or ->latest()->get()
            return view('finance.employee', compact('employees'));
    }

    public function create()
    {
        return view('finance.employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        Employee::create($validated);

        return redirect()->route('finance.employees')->with('success', 'Employee added successfully!');
    }



    public function destroy($id)
    {
        Employee::findOrFail($id)->delete();

        return redirect()->route('finance.employees')->with('success', 'Employee removed.');
    }
}
