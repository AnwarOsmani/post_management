// dropdown.js

// Fetch provinces and populate the dropdown
fetch('/provinces')
    .then(response => response.json())
    .then(data => {
        let provinceSelect = document.getElementById('province-select');
        data.forEach(province => {
            let option = document.createElement('option');
            option.value = province.province;
            option.textContent = province.province;
            provinceSelect.appendChild(option);
        });
    });

// Handle province selection
document.getElementById('province-select').addEventListener('change', function () {
    let province = this.value;
    clearMap(); // Clear the map before loading new data

    // Fetch postal codes for the selected province
    fetch(`/postal-codes/${province}`)
        .then(response => response.json())
        .then(data => {
            let postalCodeSelect = document.getElementById('postalcode-select');
            postalCodeSelect.disabled = false;
            postalCodeSelect.innerHTML = '<option>Select a postal code</option>'; // Reset options
            data.forEach(postalCode => {
                let option = document.createElement('option');
                option.value = postalCode.postal_cod;
                option.textContent = postalCode.postal_cod;
                postalCodeSelect.appendChild(option);
            });
        });
});

// Handle postal code selection
document.getElementById('postalcode-select').addEventListener('change', function () {
    let postalCode = this.value;
    clearMap(); // Clear any previously displayed postal code

    // Fetch geometry for the selected postal code
    fetch(`/postal-code-geometry/${postalCode}`)
        .then(response => response.json())
        .then(data => {
            let geoJSON = data.geom;  // Already in GeoJSON format

            let postalArea = L.geoJSON(JSON.parse(geoJSON), {
                style: {
                    color: 'red', // Highlight in red
                    weight: 3
                }
            }).addTo(map);

            // Zoom to fit the selected postal area
            map.fitBounds(postalArea.getBounds());
        });
});
//new 
// show all postal codes
document.getElementById('show-all-codes').addEventListener('change', function () {
    if (this.checked) {
        clearMap();
        fetch('/all-postal-codes')
            .then(response => response.json())
            .then(data => {
                data.forEach(postalCode => {
                    let geoJSON = JSON.parse(postalCode.geom);
                    let postalArea = L.geoJSON(geoJSON, {
                        style: {
                            color: 'blue', // Blue border
                            weight: 2
                        }
                    }).bindTooltip(postalCode.postal_cod, {
                        permanent: true,
                        direction: 'center',
                        className: 'postal-label'
                    }).on('click', function () {
                        // Tooltip with additional information
                        let info = `
                            <strong>Province:</strong> ${postalCode.province}<br>
                            <strong>City:</strong> ${postalCode.city}<br>
                            <strong>Post Office:</strong> ${postalCode.post_office}<br>
                            <strong>Shape Length:</strong> ${postalCode.shape_leng}<br>
                            <strong>Shape Area:</strong> ${postalCode.shape_area}
                        `;
                        postalArea.bindPopup(info).openPopup();
                    }).addTo(map);
                });
            });
    } else {
        clearMap();
    }
});
// Handle roads layer toggle
document.getElementById('show-roads').addEventListener('change', function () {
    if (this.checked) {
        fetch('/roads')
            .then(response => response.json())
            .then(data => {
                let roadLayers = [];

                data.forEach(road => {
                    let geoJSON = JSON.parse(road.geom);

                    // Check if geoJSON contains valid coordinates
                    if (geoJSON && geoJSON.coordinates && geoJSON.coordinates.length > 0) {
                        let roadLayer = L.geoJSON(geoJSON, {
                            style: {
                                color: 'green',  // Roads shown in green
                                weight: 2
                            }
                        }).bindTooltip(`District: ${road.district}<br>Length: ${road.shape_leng}`, {
                            permanent: false,
                            direction: 'center',
                            className: 'road-label'
                        });

                        roadLayers.push(roadLayer);
                    }
                });

                // Add the road layers to a layer group
                roadLayerGroup = L.layerGroup(roadLayers).addTo(map);
            })
            .catch(error => console.error('Error fetching roads data:', error));
    } else {
        // Remove the roads layer group if checkbox is unchecked
        if (roadLayerGroup) {
            map.removeLayer(roadLayerGroup);
        }
    }
});
