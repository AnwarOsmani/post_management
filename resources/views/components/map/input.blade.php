@props(['label', 'id', 'placeholder'])

<div class="mt-4 text-sm">
    <label for="{{ $id }}" class="text-gray-200 block">{{ $label }}</label>
    <input type="text" id="{{ $id }}" placeholder="{{ $placeholder }}"
        class="w-full mt-1 p-2 bg-gray-800 text-gray-200 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
</div>