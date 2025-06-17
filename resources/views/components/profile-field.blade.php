@props(['label', 'name', 'value' => '', 'type' => 'text', 'readonly' => false, 'required' => false])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}"
        @if ($readonly) readonly class="bg-gray-100" @endif
        @if ($required) required @endif
        class="w-full border-gray-300 border p-3 rounded-lg focus:ring focus:ring-blue-300">
</div>
