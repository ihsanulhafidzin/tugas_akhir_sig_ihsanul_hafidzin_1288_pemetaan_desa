@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Map Lokasi - Leaflet</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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
            <h3>Map Lokasi</h3>
            <div id="map"></div>
        </div>

        <script>
            // Membuat peta dan mengatur tampilan awal
            var map = L.map('map').setView([-6.646382878096672, 110.67895066058283],
                15); // Sesuaikan dengan lokasi awal (Indonesia)

            // Menambahkan layer tile dari OpenStreetMap
            // Layer OpenStreetMap
            var osmLayer = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });

            // Layer Peta Satelit ESRI
            var esriSateliteLayer = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; <a href="https://www.esri.com/">Esri</a>'
                });

            // Menambahkan kontrol untuk memilih layer peta
            var baseLayers = {
                "OpenStreetMap": osmLayer,
                "ESRI Satelit": esriSateliteLayer
            };
            L.control.layers(baseLayers).addTo(map);

            // Menambahkan layer peta default
            osmLayer.addTo(map);

            // Data lokasi dari database
            var lokasis = @json($lokasis);

            // Loop untuk menambahkan marker ke peta
            lokasis.forEach(function(lokasi) {
                // Menguraikan koordinat
                var koordinat = lokasi.koordinat.split(',');

                // Menambahkan marker ke peta
                var marker = L.marker([parseFloat(koordinat[0]), parseFloat(koordinat[1])]).addTo(map);

                // Menambahkan popup ke marker dengan data dari database
                marker.bindPopup(
                    `<b>${lokasi.nama_lokasi}</b><br>` +
                    `<img src="/storage/${lokasi.gambar_lokasi}" alt="${lokasi.nama_lokasi}" width="100"><br>` +
                    `<p>${lokasi.deskripsi}</p>` +
                    `<p><small>Koordinat: ${lokasi.koordinat}</small></p>`
                );
            });
        </script>
    </body>

    </html>
@endsection
