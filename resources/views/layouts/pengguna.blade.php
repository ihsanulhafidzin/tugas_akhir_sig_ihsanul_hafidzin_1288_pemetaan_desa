<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Geomap') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header Styles */
        header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2rem;
            margin: 0;
        }

        /* Navbar Styles */
        nav {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 0.8rem 0;
            text-align: center;
            margin-top: 0;
            /* Remove margin-top from the navbar */
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.6rem 1rem;
            border-radius: 4px;
            transition: background-color 0.3s, border-bottom 0.3s;
        }

        nav a:hover {
            background-color: #575757;
        }

        nav a.active {
            background-color: #575757;
            border-bottom: 3px solid #ffcc00;
        }

        nav a img {
            width: 24px;
            /* Ukuran lebar gambar */
            height: 24px;
            /* Ukuran tinggi gambar */
            margin-right: 8px;
            /* Jarak antara gambar dan teks */
            vertical-align: middle;
            /* Menyelaraskan gambar dengan teks */
            border-radius: 4px;
            /* Opsional: membuat sudut gambar sedikit melengkung */
            transition: transform 0.3s ease-in-out;
            /* Menambahkan efek hover */
        }

        nav a:hover img {
            transform: scale(1.2);
            /* Membesarkan gambar sedikit saat hover */
        }

        /* Content Area */
        .content-area {
            padding: 2rem;
            margin-top: 0.1rem;
            /* Reduced margin-top here */
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            flex: 1;
        }

        .content-area main {
            margin-top: 0.1rem;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
        }

        /* Footer Styles */
        footer {
            background-color: #2d3748;
            /* Warna abu gelap */
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            font-size: 14px;
            margin: 0;
            color: #a0aec0;
            /* Warna teks abu */
        }

        footer .social-icons {
            margin-top: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        footer .icon {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        footer .icon a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #4a5568;
            /* Warna dasar ikon */
            color: #fff;
            font-size: 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Sedikit bayangan */
        }

        footer .icon a:hover {
            background-color: #63b3ed;
            /* Warna saat hover */
            transform: scale(1.1);
            /* Efek zoom */
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
            /* Bayangan lebih besar */
        }

        footer .icon span {
            margin-top: 8px;
            font-size: 12px;
            color: #a0aec0;
            /* Warna teks abu */
            transition: color 0.3s ease;
        }

        footer .icon a:hover+span {
            color: #63b3ed;
            /* Ubah warna teks saat hover ikon */
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .content-area {
                margin: 1rem;
            }

            footer {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Geomap Desa Sukosono</h1>
    </header>
    <nav>
        <a href="{{ route('dashboard') }}" id="menu-dashboard"
            class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <img src="{{ asset('uploads/imgCover/dashboard.png') }}" alt="GeoMaps Logo" />
            <span>Dashboard</span>
        </a>
        <a href="{{ route('map') }}" id="menu-map" class="menu-item {{ request()->is('map') ? 'active' : '' }}">
            <img src="{{ asset('uploads/imgCover/maps.png') }}" alt="GeoMaps Logo" />
            <span>Map Lokasi</span>
        </a>
        <a href="{{ route('maphan') }}" id="menu-maphan"
            class="menu-item {{ request()->is('maphan') ? 'active' : '' }}">
            <img src="{{ asset('uploads/imgCover/tani.png') }}" alt="GeoMaps Logo" />
            <span>Map Lahan</span>
        </a>
        <a href="{{ route('laporan.create') }}" id="menu-laporan"
            class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}">
            <img src="{{ asset('uploads/imgCover/laporan.png') }}" alt="GeoMaps Logo" />
            <span>Laporan</span>
        </a>
        <a href="{{ route('login') }}" id="menu-login" class="menu-item {{ request()->is('login') ? 'active' : '' }}">
            <img src="{{ asset('uploads/imgCover/admin.png') }}" alt="GeoMaps Logo" />
            <span>Admin Login</span>
        </a>
    </nav>

    <div class="content-area" id="content-area">
        <!-- Default content goes here -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <footer>
        <div class="social-icons">
            <div class="icon">
                <a href="https://wa.me/083845043019" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <span>WhatsApp</span>
            </div>
            <div class="icon">
                <a href="https://instagram.com/username" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <span>Instagram</span>
            </div>
            <div class="icon">
                <a href="https://twitter.com/username" target="_blank">
                    <i class="fab fa-twitter"></i>
                </a>
                <span>Twitter</span>
            </div>
            <div class="icon">
                <a href="https://facebook.com/username" target="_blank">
                    <i class="fab fa-facebook"></i>
                </a>
                <span>Facebook</span>
            </div>
            <div class="icon">
                <a href="https://tiktok.com/@username" target="_blank">
                    <i class="fab fa-tiktok"></i>
                </a>
                <span>TikTok</span>
            </div>

        </div>
        <p>&copy; Geomap Sukosono 2024</p>
    </footer>
</body>

</html>
