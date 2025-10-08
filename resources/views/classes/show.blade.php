
@extends('layouts.app')

@section('title', 'Class: ' . $class_name)

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-semibold mb-4">Class: {{ $class_name }}</h2>

    <a href="{{ route('classes.index') }}" class="text-blue-500 mb-4 inline-block">&larr; Back to Classes</a>

    <table class="w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 text-left">Student Name</th>
                <th class="p-2 text-left">Attendance Count</th>
                <th class="p-2 text-left">Amount Due</th>
                <th class="p-2 text-left">Amount Paid</th>
                <th class="p-2 text-left">Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr class="border-t">
                    <td class="p-2">{{ $student->name }}</td>
                    <td class="p-2">{{ $student->attendance_count }}</td>
                    <td class="p-2">Ksh {{ number_format($student->amount_due, 2) }}</td>
                    <td class="p-2">Ksh {{ number_format($student->amount_paid, 2) }}</td>
                    <td class="p-2 font-semibold text-red-600">Ksh {{ number_format($student->balance, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
