<x-map-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Showing Map') }}
        </h2>
    </x-slot>

    <div id="map" class="inset-0 z-[1] h-full w-full">
        <!-- Leaflet Map will be rendered here -->

    </div>
</x-map-layout>
