<!-- resources/views/packages/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Package Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-semibold mb-4">Add Package Details</h1>

                    <form action="{{ route('package.store', $deliveryRequest->id) }}" method="POST">
                        @csrf

                        <!-- Package Weight -->
                        <div class="mb-4">
                            <x-input-label for="weight" :value="__('Package Weight (kg)')" />
                            <x-text-input id="weight" class="block mt-1 w-full" type="number" name="weight"
                                :value="old('weight')" required />
                            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
                        </div>

                        <!-- Delivery Price -->
                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Delivery Price ($)')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                                :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Add Package') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>