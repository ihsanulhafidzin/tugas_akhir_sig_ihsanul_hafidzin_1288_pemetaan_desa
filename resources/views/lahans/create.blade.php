@extends('layouts.app')

@section('content')
    <!-- resources/views/lahans/create.blade.php -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tambah Lahan Baru</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
        <style>
            #map {
                height: 500px;
                width: 100%;
                margin-top: 10px;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Tambah Lahan Baru</h1>

            <form action="{{ route('lahans.store') }}" method="POST">
                @csrf
                <!-- Input Nama Lahan -->
                <label for="nama_lahan">Nama Lahan:</label>
                <input type="text" name="nama_lahan" id="nama_lahan" required><br><br>

                <!-- Input Deskripsi -->
                <label for="deskripsi">Ukuran Lahan:</label>
                <textarea name="deskripsi" id="deskripsi" required></textarea><br><br>

                <button type="submit">Simpan</button>
                <!-- Peta Interaktif -->
                <div id="map"></div>

                <!-- Hidden Input untuk Data GeoJSON -->
                <input type="hidden" name="geojson_data" id="geojson_data" required>

                <!-- Tombol Simpan -->

            </form>

            <a href="{{ route('lahans.index') }}">Kembali ke Daftar Lahan</a>
        </div>

        <!-- Script Leaflet dan Leaflet Draw -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
        <script>
            // Inisialisasi peta dengan pusat di Indonesia
            var map = L.map('map').setView([-6.645189322711345, 110.67792069238702], 17);

            // Tambahkan layer ESRI World Imagery (Satelit)
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri — Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community'
            }).addTo(map);

            // Layer untuk menggambar polygon
            var drawnItems = new L.FeatureGroup();
            map.addLayer(drawnItems);

            // Kontrol Leaflet Draw
            var drawControl = new L.Control.Draw({
                edit: {
                    featureGroup: drawnItems
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

            // Event saat menggambar selesai
            map.on('draw:created', function(e) {
                var layer = e.layer;

                // Hapus layer lama
                drawnItems.clearLayers();
                drawnItems.addLayer(layer);

                // Ambil data GeoJSON
                var geojson = layer.toGeoJSON();
                document.getElementById('geojson_data').value = JSON.stringify(geojson);
            });

            // Event saat mengedit polygon
            map.on('draw:edited', function() {
                var geojson = drawnItems.toGeoJSON();
                document.getElementById('geojson_data').value = JSON.stringify(geojson);
            });
        </script>
    </body>

    </html>
@endsection
