@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Laporan</h1>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Laporan</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporans as $laporan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: justify; line-height: 1.6; word-wrap: break-word;">
                            {!! nl2br(e(Str::limit($laporan->laporan, 500))) !!}
                        </td>
                        <td>
                            @if ($laporan->gambar)
                                <img src="{{ asset('storage/' . $laporan->gambar) }}" alt="Gambar" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('laporan.show', $laporan) }}" class="btn btn-warning btn-sm">lihat</a>
                            <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
