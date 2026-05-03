@props(['active' => false, 'href' => '#'])

@php
$classes = $active
    ? 'text-red-600 font-bold border-b-2 border-red-600 pb-1'
    : 'text-gray-700 hover:text-red-600 transition';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>