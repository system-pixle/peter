@extends('layouts.app')

@section('title', 'Manage Employees')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">Employees Management</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('finance.employees.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Add Employee
    </a>

    <table class="w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border p-2">Name</th>
                <th class="border p-2">Position</th>
                <th class="border p-2">Salary (KSh)</th>
                <th class="border p-2 w-32">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td class="border p-2">{{ $employee->name }}</td>
                    <td class="border p-2">{{ $employee->position }}</td>
                    <td class="border p-2">{{ number_format($employee->salary, 2) }}</td>
                    <td class="border p-2">
                        <form action="{{ route('finance.employees.destroy', $employee->id) }}" method="POST" onsubmit="return confirm('Delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 p-4">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
