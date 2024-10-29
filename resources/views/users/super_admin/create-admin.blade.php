<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Creating account for your new worker') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-1/2 mx-auto p-6 text-gray-900">

                    <form action="{{ route('admin.store.worker') }}" method="POST">
                        @csrf

                        {{-- Name Input Field --}}
                        <div class="form-group">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required
                                autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email Input Field --}}
                        <div class="form-group mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password Input Field --}}
                        <div class="form-group mt-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Postal Code Input Field --}}
                        <div class="form-group mt-4">
                            <x-input-label for="postal_code" :value="__('Postal Code')" />
                            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                                required />
                            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
                        </div>

                        {{-- Submit Button --}}
                        <div class="mt-6">
                            <x-primary-button>
                                {{ __('Create Worker') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-app-layout>