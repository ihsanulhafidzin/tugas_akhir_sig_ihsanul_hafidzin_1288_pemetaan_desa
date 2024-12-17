@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Lokasi - Leaflet</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

        <style>
            body {
                height: 100%;
                margin: 0;
            }

            #map-container {
                margin-top: 20px;
            }

            .detail-container {
                display: flex;
                flex-wrap: wrap;
                margin-top: 20px;
            }

            .map-section {
                flex: 2;
                height: 500px;
            }

            .detail-section {
                flex: 1;
                padding-left: 20px;
            }

            .leaflet-container {
                height: 100%;
                width: 100%;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <a class="btn btn-primary mb-3" href="{{ url()->previous() }}">Kembali</a>

            <div class="detail-container">
                <!-- Bagian Peta -->
                <div class="map-section" id="map-container">
                    <div id="map"></div>
                </div>

                <!-- Bagian Detail -->
                <div class="detail-section">
                    <h3>Detail Lokasi</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">ID</th>
                                <td>{{ $lokasi->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>{{ $lokasi->nama_lokasi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Koordinat</th>
                                <td>{{ $lokasi->koordinat }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Gambar</th>
                                <td>
                                    @if ($lokasi->gambar_lokasi)
                                        <img src="{{ asset('storage/' . $lokasi->gambar_lokasi) }}"
                                            alt="{{ $lokasi->nama_lokasi }}" width="100">
                                    @else
                                        <p>Tidak ada gambar</p>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Deskripsi</th>
                                <td>{{ $lokasi->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Ditambahkan</th>
                                <td>{{ $lokasi->created_at }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Diperbarui</th>
                                <td>{{ $lokasi->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Membuat peta dan mengatur tampilan awal di lokasi yang sudah ada
            var map = L.map('map').setView([{{ $lokasi->koordinat }}], 19);

            // Menambahkan layer tile dari OpenStreetMap
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {

            }).addTo(map);

            var marker = L.marker([{{ $lokasi->koordinat }}]).addTo(map);

            // Menambahkan popup ke marker dengan informasi nama, dan lokasi
            marker.bindPopup('<b>{{ $lokasi->nama_lokasi }}</b><br>Koordinat: {{ $lokasi->koordinat }}').openPopup();
        </script>
    </body>

    </html>
@endsection
