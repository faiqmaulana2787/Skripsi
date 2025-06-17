@props(['label', 'value', 'icon' => ''])

<div>
    <label class="block text-sm text-gray-500 font-medium mb-1">{{ $label }}</label>
    <div class="flex items-center text-gray-800 text-lg font-semibold">
        @if ($icon)
            <i class="fas fa-{{ $icon }} mr-2 text-blue-600"></i>
        @endif
        <span>{{ $value }}</span>
    </div>
</div>
