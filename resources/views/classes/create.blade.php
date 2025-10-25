@extends('layouts.app')

@section('title', 'Add New Class')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl mx-auto">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">➕ Add New Class</h1>
            <p class="text-gray-600 text-sm">Create a new class and assign a class teacher if available.</p>
        </div>
        <a href="{{ route('classes.index') }}" class="text-sm text-gray-600 hover:underline">
            ← Back to Classes
        </a>
    </div>

    {{-- Authorization Check --}}
    @if(! in_array(Auth::user()->role, ['admin', 'director']))
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-3 rounded">
            ⚠️ You are not authorized to add new classes.
        </div>
    @else

        {{-- Flash Success Message --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 p-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Create Class Form --}}
        <form action="{{ route('classes.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Class Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Class Name <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                    placeholder="e.g. Grade 1, Form 2B"
                >
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Teacher Selection --}}
            <div>
                <label for="teacher_name" class="block text-sm font-medium text-gray-700">
                    Assign Teacher (optional)
                </label>

                @if (isset($teachers) && $teachers->count())
                    <select
                        id="teacher_name"
                        name="teacher_name"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                    >
                        <option value="">-- Select Teacher --</option>
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->name }}" {{ old('teacher_name') == $teacher->name ? 'selected' : '' }}>
                                {{ $teacher->name }} @if($teacher->subject) — {{ $teacher->subject }} @endif
                            </option>
                        @endforeach
                    </select>
                @else
                    <input
                        id="teacher_name"
                        name="teacher_name"
                        value="{{ old('teacher_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                        placeholder="Type teacher name (no teachers found)"
                    >
                @endif

                @error('teacher_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <p class="text-xs text-gray-500 mt-1">
                    <a href="{{ route('teachers.create') }}" class="text-blue-600 hover:underline">
                        ➕ Add a new teacher
                    </a> if not listed.
                </p>
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">
                    Description (optional)
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="3"
                    class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2 focus:ring focus:ring-blue-200 focus:border-blue-400"
                    placeholder="Enter details like subjects, remarks, or class stream notes..."
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Action Buttons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('classes.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded text-sm text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm">
                    💾 Save Class
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
