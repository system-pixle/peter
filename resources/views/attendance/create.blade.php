@extends('layouts.app')

@section('title', 'Mark Attendance')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-4xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">Mark Attendance</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Date</label>
            <input type="date" name="date" required class="border-gray-300 rounded p-2">
        </div>

        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Student Name</th>
                    <th class="border p-2">Present</th>
                    <th class="border p-2">Absent</th>
                    <th class="border p-2">Late</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td class="border p-2">{{ $student->name }}</td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="present" checked>
                        </td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="absent">
                        </td>
                        <td class="border p-2 text-center">
                            <input type="radio" name="status[{{ $student->id }}]" value="late">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('attendance.index') }}" class="text-gray-600 hover:underline">← Back</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Save Attendance
            </button>
        </div>
    </form>
</div>
@endsection
