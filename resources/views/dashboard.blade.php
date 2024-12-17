@extends('layouts.pengguna')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List of Berita</title>
        <!-- Bootstrap CSS for modern styling -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Additional styling for cards and buttons */
            .card {
                border: none;
                border-radius: 15px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }

            .card-img-top {
                border-bottom: 2px solid #f0f0f0;
                border-radius: 10px 10px 0 0;
                height: 200px;
                object-fit: cover;
            }

            .card-body {
                padding: 20px;
            }

            .card-title {
                font-size: 1.25rem;
                font-weight: 600;
                color: #333;
                margin-bottom: 15px;
            }

            .card-text {
                font-size: 0.95rem;
                color: #555;
                margin-bottom: 20px;
            }

            .btn-read-more {
                background-color: #007bff;
                color: white;
                font-weight: bold;
                border-radius: 5px;
                padding: 10px 15px;
                text-decoration: none;
                display: inline-block;
                transition: background-color 0.3s ease;
            }

            .btn-read-more:hover {
                background-color: #0056b3;
            }

            .container {
                max-width: 1200px;
            }
        </style>
    </head>

    <body>
        <div class="container mt-4">
            <div class="row">
                @foreach ($beritas as $berita)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar" class="card-img-top">
                            @else
                                <img src="https://via.placeholder.com/400x200?text=No+Image" alt="No Image"
                                    class="card-img-top">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text">
                                    <!-- Optional short description -->
                                    {{ Str::limit($berita->berita, 100) }}
                                </p>
                                <a href="{{ route('acara.show', $berita->id) }}" class="btn btn-read-more">
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Optional: Add Bootstrap JS for additional functionality -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
@endsection
