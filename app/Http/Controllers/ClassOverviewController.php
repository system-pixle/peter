<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schoolclass;
use App\Models\User; // ✅ use User instead of Teacher

class ClassOverviewController extends Controller
{
    /**
     * Display all classes with student count.
     */
    public function index()
    {
        $classes = Schoolclass::withCount('students')->get();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show form to create new class.
     */
    public function create()
    {
        // Authorization: controller-level guard
        if (!in_array(auth()->user()->role, ['admin', 'director'])) {
            abort(403);
        }

        // ✅ Get teachers from User model where role = 'teacher'
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();

        return view('classes.create', compact('teachers'));
    }

    /**
     * Store a new class in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:schoolclasses,name',
            'teacher_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Schoolclass::create($request->only(['name', 'teacher_name', 'description']));

        return redirect()->route('classes.index')->with('success', 'Class added successfully!');
    }

    /**
     * Show details for one class.
     */
    public function show($class_name)
    {
        $class = Schoolclass::where('name', $class_name)
                            ->with('students')
                            ->firstOrFail();

        return view('classes.show', compact('class'));
    }

    /**
     * Show edit form for a specific class.
     */
    public function edit($id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'director'])) {
            abort(403, 'Unauthorized action.');
        }

        $class = Schoolclass::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    /**
     * Update class info.
     */
    public function update(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'director'])) {
            abort(403, 'Unauthorized action.');
        }

        $class = Schoolclass::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:schoolclasses,name,' . $class->id,
            'teacher_name' => 'nullable|string',
        ]);

        $class->update([
            'name' => $request->name,
            'teacher_name' => $request->teacher_name,
        ]);

        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Delete a class.
     */
    public function destroy($id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'director'])) {
            abort(403, 'Unauthorized action.');
        }

        $class = Schoolclass::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}
