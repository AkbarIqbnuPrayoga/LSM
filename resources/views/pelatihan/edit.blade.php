@extends('index')

{{-- Tambahkan Boxicons --}}
@push('styles')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('content')
<main id="main">
<div class="container mt-5">
            <h3 class="mb-4 fw-bold"><i class='bx bx-edit-alt me-2'></i>Edit Pelatihan</h3>

            <form id="formEditPelatihan" action="{{ route('pelatihan.update', $pelatihan->id) }}" method="POST" enctype="multipart/form-data">
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
                {{-- Biaya --}}
                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold"><i class='bx bx-money me-1'></i>Biaya Pelatihan (Rp)</label>
                    <input type="number" class="form-control form-control sm w-auto" id="harga" name="harga" min="0" 
                        value="{{ old('harga', $pelatihan->harga) }}" required>
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
                    @php
                        $tagData = old('tag') ?? (is_string($pelatihan->tag) ? explode(',', $pelatihan->tag) : []);
                        $tags = is_array($tagData) ? $tagData : explode(',', strval($tagData));
                    @endphp

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="offline" id="tagOffline"
                            {{ in_array('offline', $tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tagOffline">Offline</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="online" id="tagOnline"
                            {{ in_array('online', $tags) ? 'checked' : '' }}>
                        <label class="form-check-label" for="tagOnline">Online</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="hybrid" id="tagHybrid"
                            {{ in_array('hybrid', $tags) ? 'checked' : '' }}>
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
                    <label for="tanggal" class="form-label fw-semibold"><i class='bx bx-calendar me-1'></i>Batas Pendaftaran</label>
                    <input type="date" class="form-control form-control-sm w-auto" id="tanggal" name="tanggal" 
                        value="{{ old('tanggal', \Carbon\Carbon::parse($pelatihan->tanggal)->format('Y-m-d')) }}" required>
                </div>

                {{-- Tanggal Mulai --}}
                <div class="mb-3">
                    <label for="tanggal_mulai" class="form-label fw-semibold">
                        <i class='bx bx-calendar me-1'></i>Tanggal Mulai
                    </label>
                    <input type="date" class="form-control form-control-sm w-auto" id="tanggal_mulai" name="tanggal_mulai" 
                        value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->format('Y-m-d')) }}" required>
                </div>

                {{-- Tanggal Selesai --}}
                <div class="mb-3">
                    <label for="tanggal_selesai" class="form-label fw-semibold">
                        <i class='bx bx-calendar me-1'></i>Tanggal Selesai
                    </label>
                    <input type="date" class="form-control form-control-sm w-auto" id="tanggal_selesai" name="tanggal_selesai" 
                        value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->format('Y-m-d')) }}" required>
                </div>


                {{-- Status --}}
                <div class="mb-3">
                    <label for="status" class="form-label fw-semibold"><i class='bx bx-lock-alt me-1'></i>Status</label>
                    <select class="form-select form-control sm w-auto" id="status" name="status" required>
                        <option value="public" {{ $pelatihan->status == 'public' ? 'selected' : '' }}>Public</option>
                        <option value="private" {{ $pelatihan->status == 'private' ? 'selected' : '' }}>Private</option>
                    </select>
                </div>
                {{-- Waktu Mulai --}}
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label fw-semibold">
                        <i class='bx bx-time me-1'></i>Waktu Mulai
                    </label>
                    <input type="time"
                        class="form-control form-control sm w-auto"
                        id="waktu_mulai"
                        name="waktu_mulai"
                        value="{{ old('waktu_mulai', \Carbon\Carbon::parse($pelatihan->waktu_mulai)->format('H:i')) }}"
                        required>
                </div>

                {{-- Waktu Selesai --}}
                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label fw-semibold">
                        <i class='bx bx-time-five me-1'></i>Waktu Selesai
                    </label>
                    <input type="time"
                        class="form-control form-control sm w-auto"
                        id="waktu_selesai"
                        name="waktu_selesai"
                        value="{{ old('waktu_selesai', \Carbon\Carbon::parse($pelatihan->waktu_selesai)->format('H:i')) }}"
                        required>
                </div>


                {{-- Konten --}}
                <div class="mb-3">
                <label class="form-label"><i class="bi bi-text-left me-1"></i>Isi Berita / Konten</label>

                <!-- Toolbar -->
                <div class="toolbar mb-2">

                    <select onchange="execCmdWithArg('fontSize', this.value)">
                        <option value="">Ukuran</option>
                        <option value="1">Kecil</option>
                        <option value="3">Normal</option>
                        <option value="5">Besar</option>
                    </select>
                    <!-- Font family -->
                    <select onchange="execCmdWithArg('fontName', this.value)">
                        <option value="">Font</option>
                        <option value="Arial">Arial</option>
                        <option value="Courier New">Courier</option>
                        <option value="Times New Roman">Times</option>
                    </select>

                    <button type="button" onclick="execCmd('bold')"><b>B</b></button>
                    <button type="button" onclick="execCmd('italic')"><i>I</i></button>
                    <button type="button" onclick="execCmd('underline')"><u>U</u></button>
                    <button type="button" onclick="execCmd('insertUnorderedList')">• Bullet</button>
                    <button type="button" onclick="execCmd('insertOrderedList')">1. Numbering</button>
                    <button type="button" onclick="execCmd('justifyLeft')">⯇</button>
                    <button type="button" onclick="execCmd('justifyCenter')">⯀</button>
                    <button type="button" onclick="execCmd('justifyRight')">⯈</button>
                    <button type="button" onclick="execCmd('justifyFull')">☰</button>
                    <button type="button" onclick="createLink()">🔗 Link</button>
                    <button type="button" onclick="execCmd('removeFormat')">🧹 Bersihkan</button>
                    <button type="button" onclick="insertImage()">🖼 Gambar</button>
                </div>

                <!-- Editable Area -->
                <div id="editor" contenteditable="true" style="border:1px solid #ccc; padding:10px; min-height:200px; background:white;">{{ old('konten', $pelatihan->konten) }}</div>

                <!-- Hidden textarea for form submit -->
                <textarea name="konten" id="konten" style="display:none;">{{ old('konten', $pelatihan->konten) }}</textarea>
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
function execCmd(command) {
    document.execCommand(command, false, null);
}

function execCmdWithArg(command, arg) {
    document.execCommand(command, false, arg);
}

function createLink() {
    const url = prompt("Masukkan URL:");
    if (url) {
    document.execCommand("createLink", false, url);
    }
}

function insertImage() {
    const imageUrl = prompt("Masukkan URL gambar:");
    if (imageUrl) {
    document.execCommand('insertImage', false, imageUrl);
    }
}
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formTambahPelatihan');
    const editor = document.getElementById('editor');
    const konten = document.getElementById('konten');

    // Ambil konten dari textarea hidden dan tampilkan ke editor
    editor.innerHTML = konten.value;

    form.addEventListener('submit', function (e) {
        const editorContent = editor.innerHTML.trim();
        konten.value = editorContent;

        // Validasi kosong
        if (!editorContent || editorContent === '<br>') {
            alert('Isi Berita / Konten tidak boleh kosong.');
            e.preventDefault();
        }
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formEditPelatihan');
    const editor = document.getElementById('editor');
    const konten = document.getElementById('konten');

    // Tampilkan isi lama ke editor saat load
    editor.innerHTML = konten.value;

    // Salin isi editor ke textarea saat submit
    form.addEventListener('submit', function (e) {
        const editorContent = editor.innerHTML.trim();
        konten.value = editorContent;

        // Validasi (opsional)
        if (!editorContent || editorContent === '<br>') {
            alert('Isi Berita / Konten tidak boleh kosong.');
            e.preventDefault();
        }
    });
});
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