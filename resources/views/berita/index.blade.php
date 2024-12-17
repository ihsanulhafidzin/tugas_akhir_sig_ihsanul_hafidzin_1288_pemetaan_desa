@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Berita</h1>
        <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Berita</th>
                    <th>Gambar</th>
                    <th>Ditambahkan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($beritas as $berita)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: justify;">{!! nl2br(e(Str::limit($berita->berita, 1000))) !!}</td>
                        <td>
                            @if ($berita->gambar)
                                <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Gambar Berita" width="100">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $berita->created_at }}</td>
                        <td>
                            <a href="{{ route('berita.show', $berita->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('berita.edit', $berita->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('berita.destroy', $berita->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
