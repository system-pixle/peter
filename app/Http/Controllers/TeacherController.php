<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    // Show all teachers
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('teachers.index', compact('teachers'));
    }

    // Show create teacher form
    public function create()
    {
        return view('teachers.create');
    }

    // Store a new teacher
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        return redirect()->route('teachers.index')->with('success', 'Teacher created successfully.');
    }

    // Delete a teacher
    public function destroy(User $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}
