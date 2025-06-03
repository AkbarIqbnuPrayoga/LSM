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
                {{-- Rekening --}}
                <div id="rekening_group">
                    <label for="rekening">Nomor Rekening</label>
                    <input type="text" name="rekening" id="rekening" value="{{ old('rekening', $pelatihan->rekening) }}" class="form-control">
                    <br>
                </div>

                {{-- Atas Nama (muncul jika rekening diisi) --}}
                <div id="atas_nama_group" style="display:none;">
                    <label for="atas_nama">Atas Nama</label>
                    <input type="text" name="atas_nama" id="atas_nama" value="{{ old('atas_nama', $pelatihan->atas_nama) }}" class="form-control">
                    <br>
                </div>

                {{-- Bank (muncul jika atas nama diisi) --}}
                <div id="bank_group" style="display:none;">
                    <label for="bank">Bank</label>
                    <input type="text" name="bank" id="bank" value="{{ old('bank', $pelatihan->bank) }}" class="form-control">
                    <br>
                </div>

                {{-- Tag --}}
                <div class="mb-3">
                    <label class="form-label"><i class="bi bi-tags me-1"></i>Tag:</label><br>
                    @php $tags = explode(',', old('tag', $pelatihan->tag)) @endphp

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="offline" id="tagOffline"
                            onchange="selectOnlyThis(this)" {{ in_array('offline', $tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tagOffline">Offline</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="online" id="tagOnline"
                            onchange="selectOnlyThis(this)" {{ in_array('online', $tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tagOnline">Online</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="hybrid" id="tagHybrid"
                            onchange="selectOnlyThis(this)" {{ in_array('hybrid', $tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tagHybrid">Hybrid</label>
                    </div>
                </div>
                {{-- Zoom Link (hanya untuk online dan hybrid) --}}
                <div class="mb-3" id="zoomField" style="display: none;">
                    <label for="zoom_link" class="form-label"><i class="bi bi-camera-video"></i> Zoom Link:</label>
                    <input type="url" class="form-control" name="zoom_link" id="zoom_link" value="{{ old('zoom_link', $pelatihan->zoom_link) }}">
                </div>

                {{-- Lokasi (hanya untuk offline dan hybrid) --}}
                <div class="mb-3" id="lokasiField" style="display: none;">
                    <label for="lokasi" class="form-label"><i class="bi bi-geo-alt"></i> Lokasi:</label>
                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ old('lokasi', $pelatihan->lokasi) }}">
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const zoomField = document.getElementById('zoomField');
    const lokasiField = document.getElementById('lokasiField');
    const rekeningGroup = document.getElementById('rekening_group');
    const rekeningInput = document.getElementById('rekening');
    const atasNamaGroup = document.getElementById('atas_nama_group');
    const atasNamaInput = document.getElementById('atas_nama');
    const bankGroup = document.getElementById('bank_group');

    function toggleFields() {
        // Cek checkbox tag yang terpilih (hanya boleh 1)
        const selected = document.querySelector('input[name="tag[]"]:checked');
        const tag = selected ? selected.value : '';

        // Show/hide Zoom dan Lokasi
        zoomField.style.display = (tag === 'online' || tag === 'hybrid') ? 'block' : 'none';
        lokasiField.style.display = (tag === 'offline' || tag === 'hybrid') ? 'block' : 'none';

        // Show/hide atas_nama & bank
        const rekeningTerisi = rekeningInput.value.trim() !== '';
        const atasNamaTerisi = atasNamaInput.value.trim() !== '';

        atasNamaGroup.style.display = rekeningTerisi ? 'block' : 'none';
        bankGroup.style.display = atasNamaTerisi ? 'block' : 'none';
    }

    // Event untuk checkbox tag agar hanya 1 terpilih dan update field
    document.querySelectorAll('input[name="tag[]"]').forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Uncheck semua checkbox selain yang ini
                document.querySelectorAll('input[name="tag[]"]').forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
            }
            toggleFields();
        });
    });

    rekeningInput.addEventListener('input', toggleFields);
    atasNamaInput.addEventListener('input', toggleFields);

    // Jalankan saat halaman dimuat
    toggleFields();
});
</script>

</main>
@endsection
