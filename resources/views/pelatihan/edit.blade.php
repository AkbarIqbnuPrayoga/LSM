@extends('index')
@section('content')
<main id="main">
<div class="container mt-4">
    <h2 class="mb-4">Edit Pelatihan</h2>

    <form action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Saat Ini:</label><br>
            <img src="{{ asset('storage/' . $pelatihan->gambar) }}" width="200" class="mb-2"><br>
            <label for="gambar" class="form-label">Ganti Gambar (opsional)</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pelatihan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelatihan->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="tag" class="form-label">Tag:</label>
            <select class="form-select" id="tag" name="tag" required>
                <option value="offline" {{ $pelatihan->tag == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="online" {{ $pelatihan->tag == 'online' ? 'selected' : '' }}>Online</option>
                <option value="buku" {{ $pelatihan->tag == 'buku' ? 'selected' : '' }}>Buku</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Pelatihan</button>
        <a href="{{ url('/admin') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
