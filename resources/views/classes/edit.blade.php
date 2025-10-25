@extends('layouts.app')

@section('title', 'Edit Class')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-lg mx-auto">
    <h2 class="text-xl font-semibold mb-4">✏️ Edit Class</h2>

    <form action="{{ route('classes.update', $class) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Class Name</label>
            <input type="text" name="name" value="{{ old('name', $class->name) }}" required
                   class="w-full border border-gray-300 rounded px-3 py-2 focus:ring focus:ring-blue-200">
            @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $class->description) }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md">Update</button>
        </div>
    </form>
</div>
@endsection
