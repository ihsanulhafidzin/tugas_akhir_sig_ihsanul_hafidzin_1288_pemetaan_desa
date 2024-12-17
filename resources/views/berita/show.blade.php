@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Detail Berita</h1>

        <!-- Tanggal Berita -->
        <div class="mb-3 text-muted text-center">
            <small>{{ $berita->created_at->format('d M Y, H:i') }}</small>
        </div>

        <!-- Gambar dan Konten Berita -->
        <div class="mb-4">
            @if ($berita->gambar)
                <div class="d-flex flex-wrap align-items-start mb-4" style="gap: 20px;">
                    <!-- Gambar Berita -->
                    <div style="flex: 1; max-width: 100%;">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita"
                            class="img-fluid rounded shadow" style="width: 100%; height: auto;">
                    </div>

                    <!-- Konten Berita -->
                    <div style="flex: 2;">
                        <p style="text-align: justify; line-height: 2.0; font-size: 15px;">
                            {!! nl2br(e($berita->berita)) !!}
                        </p>
                    </div>
                </div>
            @else
                <!-- Konten Berita tanpa Gambar -->
                <p style="text-align: justify; line-height: 2.0; font-size: 15px;">
                    {!! nl2br(e($berita->berita)) !!}
                </p>
            @endif
        </div>

        <!-- Tombol Kembali -->
        <div class="text-center">
            <a href="{{ route('berita.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection
