@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Add New Employee</h1>

    <form action="{{ route('finance.employees.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Position</label>
            <input type="text" name="position" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-3">
            <label class="block font-semibold mb-1">Salary (KSh)</label>
            <input type="number" name="salary" step="0.01" class="border rounded w-full p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Save
        </button>
        <a href="{{ route('finance.employees') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
