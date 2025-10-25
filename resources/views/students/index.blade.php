@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">Students List</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add Student button (Admin + Director) --}}
    @if(Auth::user()->role !== 'teacher')
        <a href="{{ route('students.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Add Student
        </a>
    @endif

    <table class="w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border p-2">Name</th>
                <th class="border p-2">Admission No</th>
                <th class="border p-2">Class</th>
                <th class="border p-2">Guardian</th>
                <th class="border p-2">Contact</th>
                @if(Auth::user()->role !== 'teacher')
                    <th class="border p-2 w-56">Actions</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @forelse ($students as $student)
                <tr>
                    <td class="border p-2">{{ $student->name }}</td>
                    <td class="border p-2">{{ $student->admission_no }}</td>
                    <td class="border p-2">{{ $student->schoolclass->name ?? 'Unassigned' }}</td>
                    <td class="border p-2">{{ $student->parent_name ?? '-' }}</td>
                    <td class="border p-2">{{ $student->contact ?? '-' }}</td>

                    @if(Auth::user()->role !== 'teacher')
                        <td class="border p-2 space-x-1">
                            <!-- Edit -->
                            <a href="{{ route('students.edit', $student->id) }}" 
                               class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                               Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Delete student?');">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                            <!-- View/Add Payments (Admin + Director only) -->
                            @if(in_array(Auth::user()->role, ['admin', 'director']))
                                <a href="{{ route('payments.index', ['student' => $student->id]) }}" 
                                   class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                   💰 Payments
                                </a>
                            @endif
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-500 p-4">No students found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
