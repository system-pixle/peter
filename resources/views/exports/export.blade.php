@extends('layouts.app')

@section('title', 'Class Reports')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold text-blue-700 mb-4">📚 Export Class Reports</h2>

    <form action="{{ route('classes.export.excel') }}" method="GET" class="flex items-center space-x-2 mb-4">
        <select name="class" class="border border-gray-300 rounded px-2 py-1">
            @foreach ($classes as $class)
                <option value="{{ $class }}">{{ $class }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
            Export to Excel
        </button>
    </form>

    <form action="{{ route('classes.export.pdf') }}" method="GET" class="flex items-center space-x-2">
        <select name="class" class="border border-gray-300 rounded px-2 py-1">
            @foreach ($classes as $class)
                <option value="{{ $class }}">{{ $class }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
            Export to PDF
        </button>
    </form>
</div>
@endsection
