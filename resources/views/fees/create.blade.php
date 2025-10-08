@extends('layouts.app')

@section('title', 'Add Fee Record')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">Add Fee Record</h1>

    <form action="{{ route('fees.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Student</label>
                <select name="student_id" class="w-full border p-2 rounded" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Term</label>
                <input type="text" name="term" class="w-full border p-2 rounded" placeholder="Term 1 2025" required>
            </div>

            <div>
                <label>Amount Due</label>
                <input type="number" step="0.01" name="amount_due" class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label>Amount Paid</label>
                <input type="number" step="0.01" name="amount_paid" class="w-full border p-2 rounded">
            </div>
        </div>

        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">Save Record</button>
    </form>
</div>
@endsection
