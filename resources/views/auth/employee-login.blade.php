<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('employee.login') }}">
        @csrf

        <!-- Province Dropdown -->
        <div>
            {{-- Postal Code --}}
            <div class="mt-4">
                <x-input-label for="postal_code" :value="__('Postal Code')" />
                <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code"
                    value="{{ old('postal_code') }}" placeholder="Enter postal code" required autocomplete="off" />
                <div id="postal_code-suggestions" class="bg-white border mt-2 rounded shadow-lg hidden">
                    <!-- Suggestions will appear here -->
                </div>
            </div>

            {{-- Selected Postal Code Info --}}
            <div id="postal_code-info" class="mt-4 text-gray-700 hidden">
                <strong>Selected:</strong> <span id="postal_code-selected-info"></span>
            </div>
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
