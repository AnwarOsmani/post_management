@props(['id', 'class' => ''])

<button id="{{ $id }}" {{ $attributes->merge(['class' => "text-gray-100 py-2 rounded-md hover:bg-blue-700 text-sm $class"]) }}>
    {{ $slot }}
</button>