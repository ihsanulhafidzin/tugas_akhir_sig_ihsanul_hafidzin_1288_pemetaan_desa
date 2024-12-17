@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Lokasi</title>
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <style>
            #map {
                height: 400px;
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1>Edit Lokasi</h1>
            <form action="{{ route('lokasis.update', $lokasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama_lokasi" class="form-label">Nama Lokasi</label>
                    <input type="text" name="nama_lokasi" class="form-control" value="{{ $lokasi->nama_lokasi }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="jenis_lokasi" class="form-label">Jenis Lokasi</label>
                    <select name="jenis_lokasi" class="form-control" required>
                        <option value="">Select</option>
                        <option value="masjid" {{ $lokasi->jenis_lokasi === 'masjid' ? 'selected' : '' }}>Masjid</option>
                        <option value="sekolah" {{ $lokasi->jenis_lokasi === 'sekolah' ? 'selected' : '' }}>Sekolah</option>
                        <option value="tempat wisata" {{ $lokasi->jenis_lokasi === 'tempat wisata' ? 'selected' : '' }}>
                            Tempat Wisata</option>
                        <option value="kantor kepala desa"
                            {{ $lokasi->jenis_lokasi === 'kantor kepala desa' ? 'selected' : '' }}>Kantor Kepala Desa
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gambar_lokasi" class="form-label">Gambar Lokasi</label>
                    <input type="file" name="gambar_lokasi" class="form-control">
                    @if ($lokasi->gambar_lokasi)
                        <p class="mt-2">Current Image:</p>
                        <img src="{{ asset('storage/' . $lokasi->gambar_lokasi) }}" alt="Gambar Lokasi"
                            style="max-width: 150px;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required>{{ $lokasi->deskripsi }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="koordinat" class="form-label">Koordinat</label>
                    <input type="text" name="koordinat" id="koordinat" class="form-control"
                        value="{{ $lokasi->koordinat }}" required>
                </div>
                <div id="map"></div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

        <script>
            // Default coordinates from the database
            const defaultCoords = "{{ $lokasi->koordinat }}" || "-6.200000,106.816666";
            const [defaultLat, defaultLng] = defaultCoords.split(',').map(coord => parseFloat(coord.trim()));

            // Initialize the map
            const map = L.map('map').setView([defaultLat, defaultLng], 15);

            // Add Esri Satellite tile layer
            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles © Esri — Source: Esri, DeLorme, NAVTEQ',
                maxZoom: 18
            }).addTo(map);

            // Add marker to map
            const marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            // Update koordinat input when marker is dragged
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                document.getElementById('koordinat').value = `${position.lat},${position.lng}`;
            });

            // Update marker position when the map is clicked
            map.on('click', function(e) {
                const {
                    lat,
                    lng
                } = e.latlng;
                marker.setLatLng([lat, lng]);
                document.getElementById('koordinat').value = `${lat},${lng}`;
            });
        </script>
    </body>

    </html>
@endsection
