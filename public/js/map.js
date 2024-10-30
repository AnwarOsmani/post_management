document.addEventListener("DOMContentLoaded", function () {
    // Check if the map container exists
    var mapContainer = document.getElementById('map');
    if (mapContainer) {
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([51.5, -0.09]).addTo(map)
            .bindPopup('Default Marker<br>Latitude: 51.5, Longitude: -0.09')
            .openPopup();
    }
});
