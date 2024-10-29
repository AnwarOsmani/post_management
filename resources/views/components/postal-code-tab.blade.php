 <!-- Postal Code Search Link -->
 <div class="hidden sm:flex space-x-8 sm:ms-10">
     <x-nav-link :href="route('map')" :active="request()->routeIs('map')">
         {{ __('Map') }}
     </x-nav-link>
 </div>
