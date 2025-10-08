@extends('layouts.app')

@section('title', 'Create Teacher')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-md mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Create New Teacher</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border-gray-300 rounded p-2">
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('teachers.index') }}" class="text-gray-600 hover:underline">← Back</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Create Teacher
            </button>
        </div>
    </form>
</div>
@endsection
