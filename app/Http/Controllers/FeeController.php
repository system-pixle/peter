<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    // List all fees
    public function index()
    {
        $fees = Fee::with('student')->get();
        return view('fees.index', compact('fees'));
    }

    // Create form
    public function create()
    {
        $students = Student::all();
        return view('fees.create', compact('students'));
    }

    // Store fee record
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount_due' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'term' => 'required|string',
        ]);

        Fee::create($request->all());

        return redirect()->route('fees.index')->with('success', 'Fee record created successfully!');
    }

    // Edit form
    public function edit(Fee $fee)
    {
        $students = Student::all();
        return view('fees.edit', compact('fee', 'students'));
    }

    // Update
    public function update(Request $request, Fee $fee)
    {
        $request->validate([
            'amount_due' => 'required|numeric|min:0',
            'amount_paid' => 'nullable|numeric|min:0',
            'term' => 'required|string',
        ]);

        $fee->update($request->all());

        return redirect()->route('fees.index')->with('success', 'Fee record updated successfully!');
    }

    // Delete
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return redirect()->route('fees.index')->with('success', 'Fee record deleted successfully!');
    }
}
