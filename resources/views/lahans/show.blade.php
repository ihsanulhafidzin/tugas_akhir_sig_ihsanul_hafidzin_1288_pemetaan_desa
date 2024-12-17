@extends('layouts.app')

@section('content')
    <!-- resources/views/lahans/show.blade.php -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Detail Lahan</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #map {
                height: 500px;
                width: 100%;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Detail Lahan: {{ $lahan->nama_lahan }}</h1>
            <p><strong>Deskripsi:</strong> {{ $lahan->deskripsi }}</p>

            <!-- Peta -->
            <div id="map"></div>

            <a href="{{ route('lahans.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Lahan</a>
        </div>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            // Inisialisasi peta
            var map = L.map('map').setView([0, 0], 2); // Default koordinat

            // Tambahkan layer OpenStreetMap
            var openStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap'
            });

            // Tambahkan layer ESRI Satelit (World Imagery)
            var esriSatelit = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles © Esri — Source: Esri, Maxar, Earthstar Geographics'
                });

            // Tambahkan ESRI Satelit sebagai default layer
            esriSatelit.addTo(map);

            // Kontrol layer untuk memilih peta dasar
            var baseMaps = {
                "OpenStreetMap": openStreetMap,
                "ESRI Satelit": esriSatelit
            };

            // Layer GeoJSON dari server
            var geojsonData = {!! $lahan->geojson_data !!}; // Data GeoJSON

            var geoJsonLayer = L.geoJSON(geojsonData).addTo(map);

            // Tambahkan Layer Control
            L.control.layers(baseMaps, {
                "Lahan Polygon": geoJsonLayer
            }).addTo(map);

            // Atur tampilan peta agar sesuai dengan polygon
            map.fitBounds(geoJsonLayer.getBounds());
        </script>
    </body>

    </html>
@endsection
