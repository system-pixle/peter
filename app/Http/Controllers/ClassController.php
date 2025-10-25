<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolclass;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    // View all classes
    public function index()
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403, 'Unauthorized access.');
        }

        $classes = Schoolclass::withCount('students')->get();
        return view('classes.index', compact('classes'));
    }

    // Show form to create class
    public function create()
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403);
        }

        return view('classes.create');
    }

    // Store new class
    public function store(Request $request)
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|unique:schoolclasses,name|max:255',
            'description' => 'nullable|string'
        ]);

        Schoolclass::create($request->only(['name', 'description']));

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    // Edit form
    public function edit(Schoolclass $class)
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403);
        }

        return view('classes.edit', compact('class'));
    }

    // Update class
    public function update(Request $request, Schoolclass $class)
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255|unique:schoolclasses,name,' . $class->id,
            'description' => 'nullable|string'
        ]);

        $class->update($request->only(['name', 'description']));

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    // Delete class
    public function destroy(Schoolclass $class)
    {
        if (!in_array(Auth::user()->role, ['admin', 'director'])) {
            abort(403);
        }

        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}
