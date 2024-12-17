@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tambah Lokasi</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

        <style>
            body {
                margin: 0;
                font-family: Arial, sans-serif;
            }

            #map {
                height: 500px;
                width: 100%;
                margin-bottom: 20px;
            }

            #form-container {
                padding: 15px;
                background: white;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body>
        <div class="container mt-4">
            <h1 class="mb-4">Tambah Lokasi Baru</h1>

            <div id="map"></div>

            <div id="form-container">
                <form method="POST" action="{{ route('lokasis.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_lokasi">Nama Lokasi:</label>
                        <input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="jenis_lokasi">Jenis Lokasi:</label>
                        <select id="jenis_lokasi" name="jenis_lokasi" class="form-control" required>
                            <option value="">Pilih Jenis Lokasi</option>
                            <option value="masjid">Masjid</option>
                            <option value="sekolah">Sekolah</option>
                            <option value="tempat wisata">Tempat Wisata</option>
                            <option value="kantor kepala desa">Kantor Kepala Desa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gambar_lokasi">Gambar Lokasi:</label>
                        <input type="file" id="gambar_lokasi" name="gambar_lokasi" class="form-control-file">
                    </div>

                    <div class="form-group">
                        <label for="koordinat">Koordinat:</label>
                        <input type="text" id="koordinat" name="koordinat" class="form-control" required
                            placeholder="Klik pada peta untuk memilih lokasi">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Lokasi</button>
                </form>
            </div>
        </div>

        <script>
            // Initialize Leaflet Map with ESRI Satellite
            var map = L.map('map').setView([-6.6457621152883055, 110.679443512194], 17);

            // Add ESRI Satellite tile layer
            L.tileLayer('https://services.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 18
            }).addTo(map);

            var marker;

            // Add marker on map click and update coordinates
            map.on('click', function(e) {
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(e.latlng).addTo(map);
                document.getElementById('koordinat').value = e.latlng.lat + ", " + e.latlng.lng;
            });

            // Update marker position based on manual input
            document.getElementById('koordinat').addEventListener('input', function() {
                var value = this.value;
                var coords = value.split(',');

                // Check if input has valid latitude and longitude
                if (coords.length === 2) {
                    var lat = parseFloat(coords[0].trim());
                    var lng = parseFloat(coords[1].trim());

                    if (!isNaN(lat) && !isNaN(lng)) {
                        // Remove old marker if exists
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        // Add marker at new position
                        marker = L.marker([lat, lng]).addTo(map);

                        // Center map to the new marker
                        map.setView([lat, lng], map.getZoom());
                    }
                }
            });

            // Update marker position based on manual input
            document.getElementById('koordinat').addEventListener('input', function() {
                var value = this.value.trim();

                // Check if input is empty
                if (value === "") {
                    // Remove marker from map if it exists
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    return; // Stop further processing
                }

                var coords = value.split(',');

                // Check if input has valid latitude and longitude
                if (coords.length === 2) {
                    var lat = parseFloat(coords[0].trim());
                    var lng = parseFloat(coords[1].trim());

                    if (!isNaN(lat) && !isNaN(lng)) {
                        // Remove old marker if exists
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        // Add marker at new position
                        marker = L.marker([lat, lng]).addTo(map);

                        // Center map to the new marker
                        map.setView([lat, lng], map.getZoom());
                    }
                }
            });
        </script>

    </body>

    </html>
@endsection
