<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Postal Code Map</title>

    <!-- leaflet-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include(\App\Helpers\NavigationHelper::getNavigationView())

        <div class="bg-white text-gray-900 pt-3 pb-2 flex items-center fixed top-0 left-0 w-full z-[1000] h-[61px]">
            <!-- Sidebar Toggle Button -->
            <span id="toggleSidebar" class="text-3xl cursor-pointer" onclick="toggleSidebar()">
                <i class="bi bi-filter-left text-gray-900 rounded-md bg-white"></i>
            </span>
        </div>

        <div class="relative pt-[61px] w-full" style="height: calc(100vh - 61px);">
            <x-map.sidebar />
            <!-- Page Content -->
            <main class="h-full">
                <div id="map" class="h-full w-full" style="height: 100%;">
                    <!-- Leaflet Map will be rendered here -->
                </div>
            </main>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let sidebarOpen = true;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebarOpen = !sidebarOpen;
            if (sidebarOpen) {
                sidebar.classList.replace('-translate-x-full', 'translate-x-0');
            } else {
                sidebar.classList.replace('translate-x-0', '-translate-x-full');
            }
        }
    </script>
    <script src="{{ asset('js/map.js') }}"></script>
</body>

</html>
