@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Proposal Laporan</h1>

        <!-- Card to display the report details -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3 class="mb-0">Detail Laporan</h3>
            </div>
            <div class="card-body">
                <!-- Report Title -->
                <div class="mb-4">
                    <h5 class="card-title text-uppercase font-weight-bold">Laporan</h5>
                    <p class="card-text">{{ $laporan->laporan }}</p>
                </div>

                <!-- Report Image (if available) -->
                <h5 class="card-title text-uppercase font-weight-bold">Gambar</h5>
                @if ($laporan->gambar)
                    <div class="d-flex align-items-center mt-4">
                        <div class="mr-4" style="flex-shrink: 0;">
                            <img src="{{ asset('storage/' . $laporan->gambar) }}" alt="Gambar" class="img-fluid"
                                style="max-width: 200px; height: auto;">
                        </div>
                    </div>
                @endif

                <!-- Additional Information -->
                <div class="mt-4">
                    <h5 class="card-title text-uppercase font-weight-bold">Tanggal</h5>
                    <p class="card-text">{{ $laporan->created_at->format('d-m-Y H:i') }}</p>
                </div>

                <div class="mt-4">
                    <h5 class="card-title text-uppercase font-weight-bold">Diperbarui pada</h5>
                    <p class="card-text">{{ $laporan->updated_at->format('d-m-Y H:i') }}</p>
                </div>

            </div>
            <div class="card-footer text-center">
                <a href="{{ route('laporan.index') }}" class="btn btn-outline-primary">Kembali ke Daftar Laporan</a>
            </div>
        </div>
    </div>
@endsection
