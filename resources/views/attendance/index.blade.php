@extends('layouts.app')

@section('title', 'Attendance Records')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">Attendance Records</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->role !== 'director')
        <a href="{{ route('attendance.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            + Mark Attendance
        </a>
    @endif

    <table class="w-full mt-6 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border p-2">Date</th>
                <th class="border p-2">Student</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Marked By</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td class="border p-2">{{ $record->date }}</td>
                    <td class="border p-2">{{ $record->student->name }}</td>
                    <td class="border p-2 capitalize">{{ $record->status }}</td>
                    <td class="border p-2">{{ $record->teacher->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-gray-500 p-4">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
