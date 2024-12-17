@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Berita</h1>
        <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="berita">Berita</label>
                <textarea class="form-control" id="berita" name="berita" rows="5">{{ old('berita', $berita->berita) }}</textarea>
                @error('berita')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
                <div class="mt-2">
                    @if ($berita->gambar)
                        <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="100">
                    @else
                        <span>No Image</span>
                    @endif
                </div>
                @error('gambar')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
@endsection
