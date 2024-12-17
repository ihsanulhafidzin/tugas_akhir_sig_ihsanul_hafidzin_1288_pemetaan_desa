<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Geomap') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">GeoMaps</div>
            <ul class="menu">
                <a href="{{ route('admin') }}" id="menu-dashboard"
                    class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
                    <img src="{{ asset('uploads/imgCover/dashboard.png') }}" alt="GeoMaps Logo" />
                    <span>Dashboard</span>
                </a>

                <li>
                    <a href="{{ route('lokasis.index') }}" id="menu-lokasi"
                        class="menu-item {{ request()->is('lokasis*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/lokasi.png') }}" alt="GeoMaps Logo" />
                        <span>Data Lokasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('lokasis.map.all') }}" id="menu-view-map"
                        class="menu-item {{ request()->is('lokasis*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/maps.png') }}" alt="GeoMaps Logo" />
                        <span>Map Lokasi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('laporan.index') }}" id="menu-laporan"
                        class="menu-item {{ request()->is('laporan*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/laporan.png') }}" alt="GeoMaps Logo" />
                        <span>Laporan</span>
                    </a>
                </li>

                <!-- New Halaman Menu Item -->
                <li>
                    <a href="{{ route('berita.index') }}" id="menu-berita"
                        class="menu-item {{ request()->is('berita*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/berita.png') }}" alt="GeoMaps Logo" />
                        <span>Berita</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('lahans.index') }}" id="menu-lahan"
                        class="menu-item {{ request()->is('lahans*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/a.jpg') }}" alt="GeoMaps Logo" />
                        <span>Lahan Pertanian</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('lahans.map') }}" id="menu-lahans-map"
                        class="menu-item {{ request()->is('lahans/map*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/tani.png') }}" alt="GeoMaps Logo" />
                        <span>Map Lahan</span>
                    </a>
                </li>

                <!-- New Users Menu Item -->
                <li>
                    <a href="{{ route('users.index') }}" id="menu-users"
                        class="menu-item {{ request()->is('users*') ? 'active' : '' }}">
                        <img src="{{ asset('uploads/imgCover/admin.png') }}" alt="GeoMaps Logo" />
                        <span>Users</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <header class="header">
                <div class="user-profile">
                    <!-- User Info Section -->
                    <div class="dropdown">
                        <a href="#" id="user-name" class="logout-btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('uploads/imgCover/profile.png') }}" alt="GeoMaps Logo" />
                            {{ Auth::user()->name }}
                        </a>
                        <!-- Dropdown Menu -->
                        <ul id="dropdown-menu" class="dropdown-menu dropdown-menu-end shadow-lg"
                            aria-labelledby="user-name">
                            <li><a class="dropdown-item" href="#" onclick="logout(event)">Logout</a></li>
                        </ul>
                    </div>

                    <!-- Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </header>
            <div class="content-area" id="content-area">

                <!-- Default content goes here -->
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Fungsi untuk menghapus kelas 'active' dari semua menu
        function removeActiveClasses() {
            const menuItems = document.querySelectorAll('.menu-item');
            menuItems.forEach(item => item.classList.remove('active'));
        }

        // Fungsi untuk menambahkan kelas 'active' pada menu yang dipilih
        function setActiveMenu(menuId) {
            removeActiveClasses();
            const selectedMenu = document.getElementById(menuId);
            if (selectedMenu) {
                selectedMenu.classList.add('active');
                localStorage.setItem('activeMenu', menuId); // Menyimpan status menu aktif ke localStorage
            }
        }

        // Menambahkan event listener untuk masing-masing menu item jika elemen ada
        const menuItems = ['menu-dashboard', 'menu-lokasi', 'menu-view-map', 'menu-laporan', 'menu-berita', 'menu-lahan',
            'menu-lahans-map', 'menu-users'
        ];
        menuItems.forEach(menuId => {
            const menu = document.getElementById(menuId);
            if (menu) {
                menu.addEventListener('click', () => setActiveMenu(menuId));
            }
        });

        // Inisialisasi status aktif pada halaman yang dimuat pertama kali
        window.addEventListener('load', function() {
            const activeMenu = localStorage.getItem('activeMenu');
            if (activeMenu) {
                setActiveMenu(activeMenu);
            } else {
                const pathname = window.location.pathname;
                if (pathname === '/admin' || pathname.includes("admin")) {
                    setActiveMenu('menu-dashboard');
                } else if (pathname.includes("lokasis")) {
                    setActiveMenu('menu-lokasi');
                } else if (pathname.includes("lokasis.map")) {
                    setActiveMenu('menu-view-map');
                } else if (pathname.includes("laporan")) {
                    setActiveMenu('menu-laporan');
                } else if (pathname.includes("halaman")) {
                    setActiveMenu('menu-berita');
                } else if (pathname.includes("lahans")) {
                    setActiveMenu('menu-lahan');
                } else if (pathname.includes("lahans.map")) {
                    setActiveMenu('menu-lahan-map');
                } else if (pathname.includes("users")) {
                    setActiveMenu('menu-users');
                }
            }
        });

        // Toggle dropdown visibility when user clicks on their name
        document.getElementById('user-name').addEventListener('click', function(event) {
            event.preventDefault();
            const dropdownMenu = document.getElementById('dropdown-menu');
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        // Logout function
        function logout(event) {
            event.preventDefault();
            if (confirm('Are you sure you want to log out?')) {
                // Hapus status menu aktif dari localStorage saat logout
                localStorage.removeItem('activeMenu');

                // Reset menu aktif ke dashboard
                setActiveMenu('menu-dashboard');

                // Kirim form logout setelah mengatur ulang menu
                document.getElementById('logout-form').submit();
            }
        }
        // Hide dropdown when clicked outside
        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            if (!dropdownMenu.contains(event.target) && event.target !== document.getElementById('user-name')) {
                dropdownMenu.style.display = 'none';
            }
        });
    </script>

    <style>
        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2d3e50;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            overflow-y: auto;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            padding: 20px 0;
            background-color: #1b2838;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .menu-item {
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.1s ease, transform cubic-bezier(0.23, 1, 0.320, 1) ease;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid #3a4e65;
        }

        .menu-item:hover {
            background-color: #575757;
        }

        .menu-item img {
            width: 20px;
            /* Lebar gambar */
            height: 20px;
            /* Tinggi gambar */
            object-fit: cover;
            /* Pastikan gambar proporsional */
            border-radius: 4px;
            /* Opsional: sudut gambar melengkung */
            margin-right: 10px;
            /* Jarak antara gambar dan teks */
            transition: transform 0.3s ease-in-out;
            /* Efek transisi saat hover */
        }

        .menu-item:hover img {
            transform: scale(1.2);
            /* Membesarkan gambar sedikit saat hover */
        }

        .menu-item.active {
            background-color: #575757;
        }

        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
            overflow-y: auto;
        }

        .header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
        }

        .content-area {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style for the logout button (user name link) */
        .logout-btn {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            position: relative;
            font-size: 16px;
            font-weight: 900;
        }

        /* Styling the dropdown menu */
        /* Parent container untuk user profile */
        .user-profile {
            position: relative;
            /* Menjadi anchor untuk posisi absolute dropdown */
            display: inline-block;
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            display: none;
            /* Default sembunyi */
            list-style: none;
            margin: 0;
            padding: 0;
            background-color: #fff;
            border: none;
            position: absolute;
            top: 100%;
            /* Posisi dropdown tepat di bawah tombol */
            right: 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 180px;
            border-radius: 8px;
            z-index: 100;
            overflow: hidden;
        }

        /* Dropdown link styling */
        .dropdown-menu li a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            text-decoration: none;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .dropdown-menu li a:hover {
            background-color: #f1f1f1;
            color: #000;
        }
    </style>
</body>

</html>
