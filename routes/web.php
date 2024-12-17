<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\LahanController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/map', [DashboardController::class, 'map'])->name('map');
Route::get('/maphan', [DashboardController::class, 'maphan'])->name('maphan');
Route::get('/acara/{id}', [DashboardController::class, 'acara'])->name('acara.show');


Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
});

Route::prefix('lokasis')->middleware('auth')->group(function () {
    // Menampilkan daftar lokasi
    Route::get('/', [LokasiController::class, 'index'])->name('lokasis.index');

    // Menampilkan form untuk membuat lokasi baru
    Route::get('/create', [LokasiController::class, 'create'])->name('lokasis.create');

    // Menyimpan lokasi baru
    Route::post('/', [LokasiController::class, 'store'])->name('lokasis.store');

    // Menampilkan detail lokasi
    Route::get('/{lokasi}', [LokasiController::class, 'show'])->name('lokasis.show');

    // Menampilkan form untuk mengedit lokasi
    Route::get('/{lokasi}/edit', [LokasiController::class, 'edit'])->name('lokasis.edit');

    // Mengupdate lokasi yang sudah ada
    Route::put('/{lokasi}', [LokasiController::class, 'update'])->name('lokasis.update');

    // Menghapus lokasi
    Route::delete('/{lokasi}', [LokasiController::class, 'destroy'])->name('lokasis.destroy');

    // Menampilkan peta dengan seluruh lokasi
    Route::get('/map/all', [LokasiController::class, 'mapall'])->name('lokasis.map.all');

    // Menampilkan detail lokasi spesifik
    Route::get('/{lokasi}/show', [LokasiController::class, 'show'])->name('lokasis.show');
});


Route::resource('laporan', LaporanController::class);

Route::middleware(['auth'])->group(function () {

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    // Menampilkan form untuk mengedit laporan
    Route::get('laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');

    // Memperbarui laporan
    Route::put('laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');

    // Menghapus laporan
    Route::delete('laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    Route::delete('laporan/{laporan}/detail', [LaporanController::class, 'detail'])->name('laporan.detail');
});

Route::prefix('berita')->middleware('auth')->group(function () {
    // Menampilkan semua berita
    Route::get('/', [BeritaController::class, 'index'])->name('berita.index');

    // Menampilkan form untuk menambah berita baru
    Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');

    // Menyimpan berita baru
    Route::post('/', [BeritaController::class, 'store'])->name('berita.store');

    // Menampilkan detail berita
    Route::get('/{berita}', [BeritaController::class, 'show'])->name('berita.show');

    // Menampilkan form untuk mengedit berita
    Route::get('/{berita}/edit', [BeritaController::class, 'edit'])->name('berita.edit');

    // Memperbarui berita
    Route::put('/{berita}', [BeritaController::class, 'update'])->name('berita.update');

    // Menghapus berita
    Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::resource('lahans', LahanController::class);
    Route::get('/peta', [LahanController::class, 'map'])->name('lahans.map');
});

use App\Http\Controllers\UserController;

Route::resource('users', UserController::class);
