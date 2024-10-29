// map.js

// Initialize the map with a default view and disable the default zoom control
var map = L.map('map', {
    zoomControl: false // Disable the default zoom control
}).setView([0, 0], 2);


// Define multiple basemaps

// OpenStreetMap basemap
var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});

// Mapbox basemap (you need an access token for this)
var mapbox = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=YOUR_ACCESS_TOKEN', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.mapbox.com/about/maps/">Mapbox</a>',
    id: 'mapbox/streets-v11',  // Choose style: streets, satellite, etc.
    tileSize: 512,
    zoomOffset: -1
});

// ESRI World Imagery basemap
var esriWorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    maxZoom: 19,
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
});

// Google Maps basemap
var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google</a>'
});

// Google Satellite basemap
var googleSatellite = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
    maxZoom: 20,
    subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
    attribution: 'Map data &copy; <a href="https://www.google.com/maps">Google</a>'
});

// Add the default basemap (OpenStreetMap) to the map
osm.addTo(map);
// Create a new layer group for home deliveries
var homeDeliveryLayer = L.layerGroup();

function checkHomeDeliveryData() {
    fetch('/home-deliveries-data')
        .then(response => response.json())
        .then(data => {
            if (data.message && data.message === 'Data is not ready yet') {
                console.log('Data is still being processed...');
                // Retry after a delay
                setTimeout(checkHomeDeliveryData, 5000); // Poll every 5 seconds
            } else {
                // Once data is available, add markers to the map
                data.forEach(function (delivery) {
                    var marker = L.marker([delivery.latitude, delivery.longitude])
                        .bindPopup('<strong>Home No: </strong>' + delivery.home_no + '<br><strong>City: </strong>' + delivery.city + '<br><strong>Province: </strong>' + delivery.province);
                    homeDeliveryLayer.addLayer(marker);
                });
            }
        });
}

// Trigger the data fetch and check status periodically
fetch('/home-deliveries-fetch')
    .then(() => {
        // Start checking if the data is ready
        checkHomeDeliveryData();
    });

// Define base maps
var baseMaps = {
    "OpenStreetMap": osm,
    "Mapbox Streets": mapbox,
    "ESRI World Imagery": esriWorldImagery,
    "Google Streets": googleStreets,
    "Google Satellite": googleSatellite
};

// Add home delivery layer as an overlay
var overlayMaps = {
    "Home Deliveries": homeDeliveryLayer
};

L.control.layers(baseMaps, overlayMaps).addTo(map);

// Create the default zoom control
var zoomControl = L.control.zoom({
    position: 'bottomright' // This will place the zoom control at the bottom right
}).addTo(map);

// Create a custom control to reposition the zoom control
function repositionZoomControl() {
    var zoomControlContainer = document.querySelector('.leaflet-control-zoom');
    zoomControlContainer.style.marginBottom = '40px'; // Add margin to push it down
}

// Call the function to reposition the zoom control
repositionZoomControl();


function showUserLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // Create a marker for user's location
            var userMarker = L.marker([lat, lon]).addTo(map);
            userMarker.bindPopup("You are here").openPopup();

            // Set the map view to user's location
            map.setView([lat, lon], 13);
        }, function () {
            alert("Geolocation is not supported by this browser or permission was denied.");
        });
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

// Add event listener to the button for showing user location
document.getElementById('locate-me-btn').addEventListener('click', function () {
    showUserLocation();
});
//function to clear layer
var roadLayerGroup;  // Define a global variable to store the roads layer

// Function to clear postal codes and other non-road layers only
function clearMap() {
    map.eachLayer(function (layer) {
        if (!(layer === roadLayerGroup)) {  // Don't remove the roads layer group
            if (layer instanceof L.GeoJSON) {  // Clear only GeoJSON layers
                map.removeLayer(layer);
            }
        }
    });
}


// Add event listener to the search button
document.getElementById('search-button').addEventListener('click', function () {
    var postalCode = document.getElementById('search-postalcode').value;

    if (postalCode) {
        clearMap();  // Clear any previous GeoJSON layer

        // Fetch geometry for the entered postal code
        fetch(`/postal-code-geometry/${postalCode}`)
            .then(response => response.json())
            .then(data => {
                if (data && data.geom) {
                    let geoJSON = data.geom;

                    // Display postal code area on the map
                    let postalArea = L.geoJSON(JSON.parse(geoJSON), {
                        style: {
                            color: 'blue',  // Highlight in blue
                            weight: 3
                        }
                    }).addTo(map);

                    // Zoom to fit the selected postal area
                    map.fitBounds(postalArea.getBounds());

                    // Bind a popup with additional postal code information
                    postalArea.bindPopup(`
                        <strong>Postal Code:</strong> ${postalCode}<br>
                        <strong>Province:</strong> ${data.province}<br>
                        <strong>City:</strong> ${data.city}
                    `);
                } else {
                    alert('Postal code not found.');
                }
            })
            .catch(error => {
                console.error('Error fetching postal code geometry:', error);
                alert('Error fetching postal code geometry.');
            });
    } else {
        alert('Please enter a postal code.');
    }
});
