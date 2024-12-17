@extends('layouts.pengguna')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lokasi Map - Leaflet</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            html,
            body {
                height: 100%;
                margin: 0;
            }

            .leaflet-container {
                height: 500px;
                width: 100%;
            }

            #map-container {
                margin-top: 20px;
            }

            .popup-content img {
                max-width: 100%;
                height: auto;
                border-radius: 8px;
                margin-top: 5px;
            }

            .popup-content {
                font-size: 14px;
                line-height: 1.6;
                text-align: justify;
                /* Justify text alignment */
            }

            .popup-content b {
                color: #2c3e50;
                font-size: 16px;
            }

            .popup-content strong {
                color: #2980b9;
            }

            .popup-content .description {
                margin-top: 5px;
                color: #7f8c8d;
            }

            .popup-content .location-details {
                margin-top: 10px;
            }

            .popup-content p {
                margin-bottom: 0;
            }

            .popup-content .location-details,
            .popup-content .description {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="map-container">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Inisialisasi peta
            var map = L.map('map').setView([-6.6467026, 110.6685222], 15);

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

            // Data lokasi dari controller
            var lokasiData = @json($lokasis);

            // Menambahkan marker untuk setiap lokasi
            lokasiData.forEach(function(lokasi) {
                var coordinates = lokasi.koordinat.split(','); // Membagi koordinat menjadi lat dan lng
                var lat = parseFloat(coordinates[0]);
                var lng = parseFloat(coordinates[1]);

                // Tambahkan marker ke peta
                var marker = L.marker([lat, lng]).addTo(map);

                // Konten popup
                var popupContent = `
                    <div class="popup-content">
                        <b>${lokasi.nama_lokasi}</b><br>
                        <div class="location-details">
                            <strong>Koordinat:</strong> ${lokasi.koordinat}<br>
                            <strong>Slug:</strong> ${lokasi.slug}<br>
                        </div>
                        <div class="description">
                            <strong>Deskripsi:</strong><br>
                            <p>${lokasi.deskripsi}</p>
                        </div>
                    </div>
                `;

                if (lokasi.gambar_lokasi) {
                    popupContent += `
                        <div class="popup-content">
                            <img src="{{ asset('uploads/imgCover/${lokasi.gambar_lokasi}') }}" alt="Gambar Lokasi">
                        </div>
                    `;
                }

                marker.bindPopup(popupContent);
            });
        </script>
    </body>

    </html>
@endsection
