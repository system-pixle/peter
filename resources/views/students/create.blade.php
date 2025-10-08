@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Add New Student</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Admission No</label>
            <input type="text" name="admission_no" value="{{ old('admission_no') }}" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Class</label>
            <input type="text" name="class" value="{{ old('class') }}" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Guardian Name</label>
            <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Guardian Contact</label>
            <input type="text" name="guardian_contact" value="{{ old('guardian_contact') }}" class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('students.index') }}" class="text-gray-600 hover:underline">← Back</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Student
            </button>
        </div>
    </form>
</div>
@endsection
