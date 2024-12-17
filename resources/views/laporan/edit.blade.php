@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Laporan</h1>
        <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="laporan" class="form-label">Laporan</label>
                <textarea name="laporan" id="laporan" class="form-control" rows="5" required>{{ $laporan->laporan }}</textarea>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control">
                @if ($laporan->gambar)
                    <p>Gambar saat ini:</p>
                    <img src="{{ asset('storage/' . $laporan->gambar) }}" alt="Gambar" width="150">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
