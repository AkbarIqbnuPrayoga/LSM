@extends('index')
@section('content')
<main id="main">
<div class="container mt-4">
    <h2 class="mb-4">Tambah Pelatihan</h2>
    <form action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" required>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelatihan</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pelatihan" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tag:</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tag[]" value="offline" id="tagOffline">
                <label class="form-check-label" for="tagOffline">Offline</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tag[]" value="online" id="tagOnline">
                <label class="form-check-label" for="tagOnline">Online</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="tag[]" value="buku" id="tagBuku">
                <label class="form-check-label" for="tagBuku">Buku</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Pelatihan</button>
    </form>

    <hr class="my-4">

    {{-- Daftar Pelatihan --}}
    <h2 class="mb-3">Kelola Pelatihan</h2>
    <form action="{{ route('pelatihan.bulkDelete') }}" method="POST" id="bulkDeleteForm">
        @csrf
        @method('DELETE')

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pilih</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Tag</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelatihan as $item)
                <tr>
                    <td><input type="checkbox" name="ids[]" value="{{ $item->id }}"></td>
                    <td><img src="{{ asset('storage/' . $item->gambar) }}" width="100"></td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ ucfirst($item->tag) }}</td>
                    <td><a href="{{ route('pelatihan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Yang Dipilih</button>
</form>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Penghapusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pelatihan yang dipilih? Aksi ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger" form="bulkDeleteForm">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection
