@extends('index')

{{-- Tambahkan Boxicons --}}
@push('styles')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')
<main id="main">
<div class="container mt-5">
            <h3 class="mb-4 fw-bold"><i class='bx bx-edit-alt me-2'></i>Edit Pelatihan</h3>

            <form action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Gambar --}}
                <div class="mb-4">
                    <label for="gambar" class="form-label fw-semibold"><i class='bx bx-image me-1'></i>Gambar Saat Ini</label><br>
                    <img src="{{ asset('storage/' . $pelatihan->gambar) }}" class="rounded mb-2" width="200">
                    <input type="file" class="form-control mt-2" id="gambar" name="gambar">
                    <small class="text-muted">* Kosongkan jika tidak ingin mengganti gambar</small>
                </div>

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold"><i class='bx bx-book-content me-1'></i>Nama Pelatihan</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelatihan->nama }}" required>
                </div>

                {{-- Tag --}}
                <div class="mb-3">
                    <label for="tag" class="form-label fw-semibold"><i class='bx bx-purchase-tag me-1'></i>Tag</label>
                    <select class="form-select form-control sm w-auto" id="tag" name="tag" required>
                        <option value="offline" {{ $pelatihan->tag == 'offline' ? 'selected' : '' }}>Offline</option>
                        <option value="online" {{ $pelatihan->tag == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="hybrid" {{ $pelatihan->tag == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                    </select>
                </div>

                {{-- Kuota --}}
                <div class="mb-3">
                    <label for="kuota" class="form-label fw-semibold"><i class='bx bx-group me-1'></i>Kuota Pelatihan</label>
                    <input type="number" class="form-control form-control sm w-auto" id="kuota" name="kuota" min="1" value="{{ old('kuota', $pelatihan->kuota) }}" required>
                </div>

                {{-- Tanggal --}}
                <div class="mb-3">
                    <label for="tanggal" class="form-label fw-semibold"><i class='bx bx-calendar me-1'></i>Tanggal Pelatihan</label>
                    <input type="date" class="form-control form-control sm w-auto" id="tanggal" name="tanggal" 
                        value="{{ old('tanggal', \Carbon\Carbon::parse($pelatihan->tanggal)->format('Y-m-d')) }}" required>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold"><i class='bx bx-lock-alt me-1'></i>Status</label>
                    <select class="form-select form-control sm w-auto" id="status" name="status" required>
                        <option value="public" {{ $pelatihan->status == 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ $pelatihan->status == 'private' ? 'selected' : '' }}>Private</option>
                    </select>
                </div>

                {{-- Konten --}}
                <div class="mb-4">
                    <label for="konten" class="form-label fw-semibold"><i class='bx bx-news me-1'></i>Isi Berita / Konten</label>
                    <textarea class="form-control" id="konten" name="konten" rows="6" required>{{ old('konten', $pelatihan->konten) }}</textarea>
                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success d-flex align-items-center">
                        <i class='bx bx-save me-1'></i> Simpan Perubahan
                    </button>
                    <a href="{{ url('/admin') }}" class="btn btn-outline-secondary d-flex align-items-center">
                        <i class='bx bx-arrow-back me-1'></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection
