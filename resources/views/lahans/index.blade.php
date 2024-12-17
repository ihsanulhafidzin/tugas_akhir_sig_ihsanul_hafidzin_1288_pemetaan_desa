@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary">Daftar Lahan</h1>
            <a href="{{ route('lahans.create') }}" class="btn btn-success">Tambah Lahan</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lahan</th>
                        <th>Ukuran Lahan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($lahans as $lahan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $lahan->nama_lahan }}</td>
                            <td>{{ $lahan->deskripsi }}</td>
                            <td class="text-center">
                                <a href="{{ route('lahans.show', $lahan->id) }}" class="btn btn-info btn-sm">
                                    Detail
                                </a>
                                <a href="{{ route('lahans.edit', $lahan->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('lahans.destroy', $lahan->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus lahan ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data lahan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
