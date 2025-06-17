@props(['route', 'label', 'icon'])

@php
    $active = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}"
    class="flex items-center space-x-2 {{ $active ? 'text-green-700 font-semibold' : 'text-gray-500 hover:text-green-700' }} transition">
    <i class="{{ $icon }}"></i>
    <span>{{ $label }}</span>
</a>
