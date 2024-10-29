<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left side: Logo and Postal Code Search -->
            <!-- Logo -->
            <!-- Postal Code Search Link -->
            <div class="flex items-center">
                <x-application-logo />
                <x-postal-code-tab />
            </div>

            <!-- Right side: Navigation Links (Login, Register, Employee Login) -->
            <div class="hidden sm:flex space-x-8 items-center">
                @guest
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('employee.login')" :active="request()->routeIs('employee.login')">
                        {{ __('Employee Login') }}
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                @else
                    <!-- Dashboard Links Based on User Role -->
                    @if (auth()->user()->role == 2)
                        <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-nav-link>
                    @elseif(auth()->user()->role == 3)
                        <x-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                            {{ __('Worker Dashboard') }}
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('User Dashboard') }}
                        </x-nav-link>
                    @endif
                @endguest
            </div>

            <!-- Hamburger Button for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @guest
            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('employee.login')" :active="request()->routeIs('employee.login')">
                {{ __('Employee Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
        @else
            @if (auth()->user()->role == 'admin')
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Admin Dashboard') }}
                </x-responsive-nav-link>
            @elseif(auth()->user()->role == 'worker')
                <x-responsive-nav-link :href="route('worker.dashboard')" :active="request()->routeIs('worker.dashboard')">
                    {{ __('Worker Dashboard') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('User Dashboard') }}
                </x-responsive-nav-link>
            @endif
        @endguest

        <x-responsive-nav-link :href="route('postal.codes.search')" :active="request()->routeIs('postal.codes.search')">
            {{ __('Search Postal Code') }}
        </x-responsive-nav-link>
    </div>
</nav>
