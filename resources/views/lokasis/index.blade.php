@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lokasi List</h1>
        <a href="{{ route('lokasis.create') }}" class="btn btn-primary">Add Lokasi</a>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lokasi</th>
                    <th>Jenis Lokasi</th>
                    <th>deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasis as $lokasi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $lokasi->nama_lokasi }}</td>
                        <td>{{ $lokasi->jenis_lokasi }}</td>
                        <td>{{ $lokasi->deskripsi }}</td>
                        <td>{{ $lokasi->koordinat }}</td>
                        <td>
                            <a href="{{ route('lokasis.edit', $lokasi) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('lokasis.show', $lokasi) }}" class="btn btn-warning">detail</a>
                            <form action="{{ route('lokasis.destroy', $lokasi) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
