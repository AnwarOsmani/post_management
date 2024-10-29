<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Track Your Package') }}
        </h2>
    </x-slot>

    <div class="py-12 flex justify-center">
        <div class="max-w-md w-full bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Search Form -->
                <form action="{{ route('package.track') }}" method="GET">
                    <label for="tracking_number" class="block text-gray-700 text-sm font-bold mb-2">
                        Enter Tracking Number:
                    </label>
                    <x-text-input name="tracking_number" id="tracking_number" type="text" required
                        placeholder="PKG-671EE285D05FA" class="w-full" />
                    <x-primary-button class="mt-4 w-full flex items-center justify-center">
                        Search
                    </x-primary-button>
                </form>

                <x-alert-messages />

                <!-- Package Status Section -->
                @isset($package)
                    <div class="mt-8 p-4 bg-gray-100 rounded-md">
                        <h3 class="font-semibold text-lg text-gray-700">Package Status</h3>
                        <p><strong>Tracking Number:</strong> {{ $package->tracking_number }}</p>
                        <p><strong>Status:</strong> {{ $status }}</p>
                        <p><strong>Created At:</strong> {{ $created_at->format('Y-m-d H:i') }}</p>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</x-app-layout>