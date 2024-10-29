<div id="sidebar"
    class="fixed bottom-0 left-0 duration-500 p-2 w-[300px] overflow-y-auto 
    text-center bg-gray-900 shadow z-[999] transition-transform translate-x-0 md:w-[240px] lg:w-[300px] h-[calc(100vh-59px)]">

    <div class="text-gray-100 text-xl">
        <div class="flex items-center rounded-md">
            <i class="bi bi-search px-2 py-1 bg-blue-600 rounded-md"></i> <!-- Changed icon to searching icon -->
            <h1 class="text-sm ml-3 text-gray-200 font-bold">Searching for Address</h1>
            <i id="closeSidebar" class="bi bi-x ml-auto cursor-pointer" onclick="toggleSidebar()"></i>
        </div>
        <x-map.hr />
        <x-map.input label="" placeholder="Enter postal code" id="search-postalcode" />
        <x-map.button id="search-button" class="mt-2 w-full bg-blue-600">Search</x-map.button>
        <x-map.hr />
        <x-map.select label="Select Province" id="province-select">
            <option>Select a province</option>
        </x-map.select>

        <x-map.select label="Select Postal Code" id="postalcode-select" disabled>
            <option>Select a postal code</option>
        </x-map.select>
        <x-map.hr />
        <x-map.checkbox label="Show All Postal Codes" id="show-all-codes" />
        <x-map.checkbox label="Show Roads" id="show-roads" />
        <x-map.hr />
        <x-map.button id="locate-me-btn" class="mt-4 w-full bg-blue-600">Show My Location</x-map.button>

    </div>
</div>
