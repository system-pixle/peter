@extends('layouts.app')

@section('title', 'Add Student Fee Record')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">➕ Add Student Fee Record</h1>

    <form action="{{ route('student_fees.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="student_id" class="block font-medium">Select Student</label>
            <select name="student_id" id="student_id" class="w-full border rounded p-2">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="term" class="block font-medium">Term</label>
            <input type="text" name="term" id="term" class="w-full border rounded p-2" placeholder="e.g. Term 1 2025" required>
        </div>

        <div>
            <label for="amount_due" class="block font-medium">Amount Due (Ksh)</label>
            <input type="number" name="amount_due" id="amount_due" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label for="amount_paid" class="block font-medium">Amount Paid (Ksh)</label>
            <input type="number" name="amount_paid" id="amount_paid" class="w-full border rounded p-2" required>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Record</button>
    </form>
</div>
@endsection
