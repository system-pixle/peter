@extends('layouts.app')

@section('title', 'Reports')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-semibold mb-6">📊 School Reports Dashboard</h1>

    {{-- Check if user is logged in and role is allowed --}}
    @auth
        @if (in_array(Auth::user()->role, ['director', 'admin']))
            <div class="flex flex-wrap justify-between mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700">Export Reports</h2>
                    <p class="text-sm text-gray-500">Select a class and export its data below.</p>
                </div>

                <div class="flex gap-3 items-center">
                    {{-- Class Selector --}}
                    <select id="classSelect" class="border border-gray-300 rounded-lg p-2">
                        <option value="Grade 1">Grade 1</option>
                        <option value="Grade 2">Grade 2</option>
                        <option value="Grade 3">Grade 3</option>
                        <option value="Grade 4">Grade 4</option>
                        <option value="Grade 5">Grade 5</option>
                        <option value="Grade 6">Grade 6</option>
                        <option value="Grade 7">Grade 7</option>
                        <option value="Grade 8">Grade 8</option>
                        <option value="Form 1">Form 1</option>
                        <option value="Form 2">Form 2</option>
                        <option value="Form 3">Form 3</option>
                        <option value="Form 4">Form 4</option>
                    </select>

                    {{-- Export Excel --}}
                    <a id="exportExcel" href="#" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                       📗 Export to Excel
                    </a>

                    {{-- Export PDF --}}
                    <a id="exportPdf" href="#" 
                       class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                       📕 Export to PDF
                    </a>
                </div>
            </div>

            {{-- JS for dynamic export links --}}
            <script>
                const classSelect = document.getElementById('classSelect');
                const excelBtn = document.getElementById('exportExcel');
                const pdfBtn = document.getElementById('exportPdf');

                function updateLinks() {
                    const selectedClass = classSelect.value;
                    excelBtn.href = `/classes/export/${encodeURIComponent(selectedClass)}/excel`;
                    pdfBtn.href = `/classes/export/${encodeURIComponent(selectedClass)}/pdf`;
                }

                classSelect.addEventListener('change', updateLinks);
                updateLinks(); // initialize on page load
            </script>
        @endif
    @endauth

    {{-- Reports Sections --}}
    <div class="grid md:grid-cols-2 gap-6 mt-6">
        {{-- Students Report --}}
        <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="text-lg font-semibold text-blue-700 mb-2">🎓 Students Report</h3>
            <p class="text-gray-600 text-sm mb-3">View and analyze student enrollment and demographics.</p>
            <a href="{{ route('students.index') }}" 
               class="text-blue-600 font-medium hover:underline">View Students</a>
        </div>

        {{-- Class Report --}}
        <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="text-lg font-semibold text-indigo-700 mb-2">🏫 Class Report</h3>
            <p class="text-gray-600 text-sm mb-3">Review class lists, subjects, and teacher allocations.</p>
            <a href="{{ route('classes.index') }}" class="text-indigo-600 font-medium hover:underline">Manage Classes</a>
        </div>

        {{-- Fees Report --}}
        <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="text-lg font-semibold text-green-700 mb-2">💰 Fees Report</h3>
            <p class="text-gray-600 text-sm mb-3">Track payments, balances, and outstanding school fees.</p>
            <a href="{{ route('fees.report') }}" 
               class="text-green-600 font-medium hover:underline">View Fees Report</a>
        </div>

        {{-- Assessment Report --}}
        <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
            <h3 class="text-lg font-semibold text-orange-700 mb-2">🧾 Assessment Report</h3>
            <p class="text-gray-600 text-sm mb-3">Analyze academic performance and continuous assessment scores.</p>
            <a href="#" 
               class="text-orange-600 font-medium hover:underline">View Assessments</a>
        </div>
    </div>
</div>
@endsection
