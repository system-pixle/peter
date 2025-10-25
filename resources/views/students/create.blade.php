@extends('layouts.app')

@section('title', 'Add New Student')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">➕ Add New Student</h2>
        <a href="{{ route('students.index') }}" class="text-sm text-gray-600 hover:underline">← Back to Students</a>
    </div>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Student Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                placeholder="Enter student name" required>
        </div>

            <label for="admission_no" class="block text-sm font-medium text-gray-700">
                Admission Number <span class="text-red-500">*</span>
            </label>
            <input type="text" name="admission_no" id="admission_no" value="{{ old('admission_no') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="e.g. ADM001" required>


        <div>
            <label for="class_name" class="block text-sm font-medium text-gray-700">
                Class Name <span class="text-red-500">*</span>
            </label>
            <input type="text" name="class_name" id="class_name"
                class="w-full border border-gray-300 rounded-md px-3 py-2"
                placeholder="Enter class (e.g. Grade 1, Grade 2)"
                value="{{ old('class_name') }}" required>
        </div>



        <div>
            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
            <select name="gender" id="gender" class="w-full border border-gray-300 rounded-md px-3 py-2">
                <option value="">-- Select Gender --</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div>
            <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" name="dob" id="dob" value="{{ old('dob') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2">
        </div>

        <div>
            <label for="parent_name" class="block text-sm font-medium text-gray-700">Parent Name</label>
            <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="e.g. John Doe">
        </div>

        <div>
            <label for="contact" class="block text-sm font-medium text-gray-700">Parent Contact</label>
            <input type="text" name="contact" id="contact" value="{{ old('contact') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2" placeholder="e.g. 0712345678">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('students.index') }}" class="inline-block px-4 py-2 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">Cancel</a>
            <button type="submit" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">Save Student</button>
        </div>
    </form>
</div>
@endsection
