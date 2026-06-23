@props(['href', 'label' => 'Kembali'])

<a href="{{ $href }}" class="mb-6 inline-flex items-center gap-2 text-sm font-medium text-navara-500 transition hover:text-navara-700">
    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
    </svg>
    {{ $label }}
</a>
