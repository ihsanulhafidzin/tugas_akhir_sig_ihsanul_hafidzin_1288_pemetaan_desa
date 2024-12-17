@extends('layouts.pengguna')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lahan Map</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            #map {
                height: 500px;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <h1>All Lahans</h1>
        <div id="map"></div>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            // Initialize the map with a default center and zoom level
            var map = L.map('map').setView([0, 0], 2); // Posisikan awal peta ke koordinat (0, 0)

            // Layer dasar OpenStreetMap
            var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            // Layer satelit ESRI
            var esriLayer = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; <a href="https://www.esri.com">Esri</a> &mdash; Source: Esri, USGS, NOAA'
                });

            // Menambahkan layer OSM secara default
            osmLayer.addTo(map);

            // Menambahkan kontrol layer
            var baseLayers = {
                "OpenStreetMap": osmLayer,
                "ESRI Satellite": esriLayer
            };

            L.control.layers(baseLayers).addTo(map);

            // Initialize a bounds variable to adjust map zoom based on all polygons
            var bounds = L.latLngBounds();

            // Loop through each 'Lahan' and add it to the map as GeoJSON
            @foreach ($lahans as $lahan)
                var geojsonData = {!! $lahan->geojson_data !!};

                // Create a GeoJSON layer for the polygon data
                var layer = L.geoJSON(geojsonData).addTo(map);

                // Bind a popup to the layer (polygon)
                layer.bindPopup('<strong>{{ $lahan->nama_lahan }}</strong><br>{{ $lahan->deskripsi }}');

                // Extend the map bounds to fit the layer (polygon)
                bounds.extend(layer.getBounds());
            @endforeach

            // Adjust the map view to fit all polygons within the map bounds
            map.fitBounds(bounds);
        </script>
    </body>

    </html>
@endsection
