@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-body custom-card-body">
                        <!-- User Greeting -->
                        <h5 class="greeting-text">Hello, {{ Auth::user()->name }}!</h5>
                        <p>Welcome back to your personal dashboard. Here you can view and manage your activities, settings,
                            and more.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Updated Container for Side-by-Side Layout -->
    <div class="container mt-5">
        <div class="row">
            <!-- Lokasi Card (Left side) -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <div class="icon-container mb-3">
                            <i class="bi bi-geo-alt-fill text-primary display-4"></i>
                        </div>
                        <h2 class="card-title text-dark">
                            <i class="fa-solid fa-map-location-dot" style="font-size: 30px;"></i> Lokasi
                        </h2>

                        <!-- Horizontal Line (Styled Separator) -->
                        <hr class="my-4 custom-hr">

                        <p class="card-text text-muted">Total Lokasi</p>
                        <h1 class="display-3 text-primary fw-bold">{{ \App\Models\lokasi::count() }}</h1>
                    </div>
                </div>
            </div>

            <!-- Laporan Card (Middle) -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <div class="icon-container mb-3">
                            <i class="bi bi-file-earmark-text-fill text-primary display-4"></i>
                        </div>
                        <h2 class="card-title text-dark">
                            <i class="fa-solid fa-file-alt" style="font-size: 30px;"></i> Laporan
                        </h2>

                        <!-- Horizontal Line (Styled Separator) -->
                        <hr class="my-4 custom-hr">

                        <p class="card-text text-muted">Total Laporan</p>
                        <h1 class="display-3 text-primary fw-bold">{{ \App\Models\laporan::count() }}</h1>
                    </div>
                </div>
            </div>

            <!-- Berita Card (Right side) -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <div class="icon-container mb-3">
                            <i class="bi bi-newspaper text-primary display-4"></i>
                        </div>
                        <h2 class="card-title text-dark">
                            <i class="fa-solid fa-newspaper" style="font-size: 30px;"></i> Berita
                        </h2>

                        <!-- Horizontal Line (Styled Separator) -->
                        <hr class="my-4 custom-hr">

                        <p class="card-text text-muted">Total Berita</p>
                        <h1 class="display-3 text-primary fw-bold">{{ \App\Models\berita::count() }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Lahan Card (Left side) -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <div class="icon-container mb-3">
                            <i class="bi bi-file-earmark-text-fill text-primary display-4"></i>
                        </div>
                        <h2 class="card-title text-dark">
                            <i class="fa-solid fa-tractor" style="font-size: 30px;"></i> Lahan
                        </h2>

                        <!-- Horizontal Line (Styled Separator) -->
                        <hr class="my-4 custom-hr">

                        <p class="card-text text-muted">Total Lahan</p>
                        <h1 class="display-3 text-primary fw-bold">{{ \App\Models\lahan::count() }}</h1>
                    </div>
                </div>
            </div>

            <!-- User Card (Right side) -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center">
                        <div class="icon-container mb-3">
                            <i class="bi bi-person-circle text-primary display-4"></i>
                        </div>
                        <h2 class="card-title text-dark">
                            <i class="fa-solid fa-users" style="font-size: 30px;"></i> User
                        </h2>

                        <!-- Horizontal Line (Styled Separator) -->
                        <hr class="my-4 custom-hr">

                        <p class="card-text text-muted">Total User</p>
                        <h1 class="display-3 text-primary fw-bold">{{ \App\Models\user::count() }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inline CSS Styles -->
    <style>
        /* Custom Horizontal Line Style */
        .custom-hr {
            border: 0;
            border-top: 2px solid #007bff;
            width: 50%;
            margin: 20px auto;
        }

        /* Custom Card Body Styling */
        .custom-card-body {
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .greeting-text {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .custom-btn {
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .custom-btn:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .custom-btn:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.6);
        }
    </style>
@endsection
