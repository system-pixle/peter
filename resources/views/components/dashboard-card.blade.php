@props([
    'title',
    'link',
    'color' => 'blue',  {{-- Default color fallback --}}
])

<div class="bg-white shadow rounded-2xl p-6 text-center hover:shadow-xl transform hover:-translate-y-1 transition duration-200">
    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $title }}</h3>
    <p class="text-gray-500 mb-4">Quick access to {{ strtolower($title) }}</p>
    <a href="{{ $link }}" class="text-{{ $color }}-600 font-semibold hover:underline">
        Go →
    </a>
</div>

<!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
