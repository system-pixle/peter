@extends('layouts.app')

@section('title', 'Welcome - Saint Paul’s Academy')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50">
    <img src="{{ asset('images/logo.png') }}" alt="Saint Paul’s Academy" class="w-32 mb-8">

    <h1 class="text-3xl font-bold text-blue-700 mb-6">Welcome to Saint Paul’s Academy CBC System</h1>

    <div class="flex gap-6">
        <a href="{{ route('login.role', 'director') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700">Director Login</a>
        <a href="{{ route('login.role', 'admin') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">Admin Login</a>
        <a href="{{ route('login.role', 'teacher') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Teacher Login</a>
    </div>
</div>
@endsection
