@extends('layouts.app')

@section('title', 'Export Classes')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-4">📤 Export Class Data</h1>

    @if(session('error'))
        <p class="text-red-600 mb-4">{{ session('error') }}</p>
    @endif

    <form class="space-y-4">
        <label for="classSelect" class="block text-gray-700 font-medium">Select Class</label>
        <select id="classSelect" class="border border-gray-300 rounded-lg p-2 w-1/2">
            @foreach($classes as $class)
                <option value="{{ $class }}">{{ $class }}</option>
            @endforeach
        </select>

        <div class="flex gap-4 mt-4">
            {{-- Export Excel --}}
            <a id="exportExcel" href="#" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md shadow">
                📗 Export to Excel
            </a>

            {{-- Export PDF --}}
            <a id="exportPdf" href="#" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow">
                📕 Export to PDF
            </a>
        </div>
    </form>
</div>

<script>
    document.getElementById('classSelect').addEventListener('change', updateLinks);

    function updateLinks() {
        const selected = document.getElementById('classSelect').value;
        document.getElementById('exportExcel').href = `/classes/export/${selected}/excel`;
        document.getElementById('exportPdf').href = `/classes/export/${selected}/pdf`;
    }

    // Trigger initial update
    updateLinks();
</script>
@endsection
