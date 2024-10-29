@props(['label', 'id'])

<div class="flex items-center mt-4 justify-center text-sm">
    <input type="checkbox" id="{{ $id }}" class="mr-2">
    <label for="{{ $id }}" class="text-gray-200">{{ $label }}</label>
</div>