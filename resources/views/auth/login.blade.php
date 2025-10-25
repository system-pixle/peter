@extends('layouts.app')

@section('title', ucfirst($role) . ' Login')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-semibold text-center mb-4">{{ ucfirst($role) }} Login</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.submit', $role) }}">
        @csrf

        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" required
                class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
        </div>

        <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Login as {{ ucfirst($role) }}
        </button>
    </form>
</div>
@endsection
