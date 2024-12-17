@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Lahan</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-draw/dist/leaflet.draw.css" />
        <style>
            #map {
                height: 500px;
                width: 100%;
            }

            .container {
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <h1>Edit Lahan</h1>

        <form action="{{ route('lahans.update', $lahan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Lahan -->
            <div>
                <label for="nama_lahan">Nama Lahan</label>
                <input type="text" name="nama_lahan" value="{{ old('nama_lahan', $lahan->nama_lahan) }}" required>
            </div>

            <!-- Deskripsi Lahan -->
            <div>
                <label for="deskripsi">Ukuran Lahan</label>
                <textarea name="deskripsi" required>{{ old('deskripsi', $lahan->deskripsi) }}</textarea>
            </div>

            <!-- Input Hidden untuk GeoJSON -->
            <input type="hidden" id="geojson_data" name="geojson_data" value="{{ $lahan->geojson_data }}">

            <!-- Map -->
            <div id="map"></div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
            <a href="{{ route('lahans.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Lahan</a>
        </form>

        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-draw/dist/leaflet.draw.js"></script>
        <script>
            // Inisialisasi Peta
            var map = L.map('map').setView([0, 0], 13); // Default view

            // Layer Peta Dasar
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


            // Layer Control
            var baseMaps = {
                "OpenStreetMap": openStreetMap,
                "ESRI Satelit": esriSatelit
            };
            L.control.layers(baseMaps).addTo(map);

            // Tambahkan Layer GeoJSON dari Database
            var drawnItems = new L.FeatureGroup().addTo(map);
            var geojsonData = {!! $lahan->geojson_data !!}; // Data GeoJSON dari database

            // Tambahkan GeoJSON ke Peta
            if (geojsonData) {
                var geoJsonLayer = L.geoJSON(geojsonData, {
                    style: {
                        color: 'blue',
                        weight: 2
                    }
                }).addTo(drawnItems);

                // Pusatkan Peta ke Polygon
                map.fitBounds(geoJsonLayer.getBounds());
            }

            // Kontrol Draw
            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnItems,
                    edit: true,
                    remove: true
                },
                draw: {
                    polygon: true,
                    rectangle: false,
                    circle: false,
                    marker: false,
                    polyline: false,
                    circlemarker: false
                }
            });
            map.addControl(drawControl);

            // Event Saat Menggambar Polygon Baru
            map.on('draw:created', function(e) {
                var layer = e.layer;

                // Hapus layer lama dan tambahkan layer baru
                drawnItems.clearLayers();
                drawnItems.addLayer(layer);

                // Ambil data GeoJSON
                var geojson = layer.toGeoJSON();
                document.getElementById('geojson_data').value = JSON.stringify(geojson);
            });

            // Event Saat Mengedit Polygon
            map.on('draw:edited', function() {
                var geojson = drawnItems.toGeoJSON();
                document.getElementById('geojson_data').value = JSON.stringify(geojson.features[0]);
            });

            // Event Saat Menghapus Polygon
            map.on('draw:deleted', function() {
                document.getElementById('geojson_data').value = null; // Kosongkan jika dihapus
            });
        </script>
    </body>

    </html>
@endsection
