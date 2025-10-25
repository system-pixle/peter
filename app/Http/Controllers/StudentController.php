<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Schoolclass;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Show all students
    public function index()
    {
        $students = Student::with('schoolclass')->get();
        return view('students.index', compact('students'));
    }

    // Show create form
    public function create()
    {
        $classes = Schoolclass::orderBy('name')->get();
        return view('students.create', compact('classes'));
    }

    // Store new student
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'admission_no' => 'required|string|unique:students,admission_no',
            'class_name' => 'required|string|max:255',
            'gender' => 'required|string',
            'dob' => 'nullable|date',
            'parent_name' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
        ]);

        Student::create([
            'name' => $request->name,
            'admission_no' => $request->admission_no,
            'class_name' => $request->class_name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'parent_name' => $request->parent_name,
            'contact' => $request->contact,
        ]);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Edit form
    public function edit(Student $student)
    {
        $classes = Schoolclass::orderBy('name')->get();
        return view('students.edit', compact('student', 'classes'));
    }

    // Update student
    public function update(Request $request, Student $student)
    {
            $request->validate([
                'name' => 'required|string|max:255',
                'admission_no' => 'required|string|unique:students,admission_no',
                'class_name' => 'required|string|max:255',
                'gender' => 'required|string',
                'dob' => 'nullable|date',
                'parent_name' => 'nullable|string|max:255',
                'contact' => 'nullable|string|max:255',
            ]);


        $student->update([
            'name' => $request->name,
            'admission_no' => $request->admission_no,
            'class_id' => $request->class_id,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'parent_name' => $request->parent_name,
            'contact' => $request->contact,
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
