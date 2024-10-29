<div>
    <!-- add the error components -->
    <h3 class="font-semibold text-lg text-gray-800 mb-4">{{ $title }}</h3>

    {{-- Name Field --}}
    <div class="mt-4">
        <x-input-label for="{{ $nameId }}" :value="__('Name')" />
        <x-text-input id="{{ $nameId }}" class="block mt-1 w-full" type="text" name="{{ $nameId }}"
            value="{{ old($nameId, $nameValue) }}" placeholder="Enter name" />
    </div>

    {{-- Phone Field --}}
    <div class="mt-4">
        <x-input-label for="{{ $phoneId }}" :value="__('Phone')" />
        <x-text-input id="{{ $phoneId }}" class="block mt-1 w-full" type="tel" name="{{ $phoneId }}"
            value="{{ old($phoneId, $phoneValue) }}" placeholder="Enter phone number" pattern="[0-9]{10,15}"
            inputmode="numeric" required />
    </div>

    {{-- Postal Code --}}
    <div class="mt-4">
        <x-input-label for="{{ $postalCodeId }}" :value="__('Postal Code')" />
        <x-text-input id="{{ $postalCodeId }}" class="block mt-1 w-full" type="text" name="{{ $postalCodeId }}"
            value="{{ old($postalCodeId, $postalCodeValue) }}" placeholder="Enter postal code" required
            autocomplete="off" />
        <div id="{{ $postalCodeId }}-suggestions" class="bg-white border mt-2 rounded shadow-lg hidden">
            <!-- Suggestions will appear here -->
        </div>
    </div>

    {{-- Selected Postal Code Info --}}
    <div id="{{ $postalCodeId }}-info" class="mt-4 text-gray-700 hidden">
        <strong>Selected:</strong> <span id="{{ $postalCodeId }}-selected-info"></span>
    </div>
</div>