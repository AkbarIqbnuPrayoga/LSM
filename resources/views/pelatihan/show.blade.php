@extends('index')

@section('content')
<div class="container py-5">
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    {{-- Kartu Detail Pelatihan --}}
    <div class="card shadow-lg border-0">
        <div class="card-body p-5">
            <h2 class="text-center mb-4 fw-bold">
                <i class="bi bi-journal-richtext"></i> {{ $pelatihan->nama }}
            </h2>

            {{-- Info Umum --}}
            <div class="row justify-content-center text-center mb-4">
                {{-- Tag --}}
                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <strong>Tag:</strong><br>
                        <span class="text-capitalize">{{ $pelatihan->tag }}</span><br><br>

                        {{-- Batas Pendaftaran --}}
                        <strong>Batas Pendaftaran:</strong><br>
                        <span class="text-capitalize">{{ \Carbon\Carbon::parse($pelatihan->tanggal)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="col-md-5 mb-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <strong>Tanggal Pelatihan:</strong><br>
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->locale('id')->translatedFormat('d F Y') }} - 
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->locale('id')->translatedFormat('d F Y') }}

                        <hr class="my-2">

                        <strong>Waktu:</strong><br>
                        <i class="bi bi-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($pelatihan->waktu_mulai)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($pelatihan->waktu_selesai)->format('H:i') }} WIB
                    </div>
                </div>

                {{-- Lokasi --}}
                <div class="col-md-3 mb-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <strong>Lokasi:</strong><br>
                        {{ $pelatihan->lokasi ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- Gambar Pelatihan --}}
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $pelatihan->gambar) }}" 
                    class="img-fluid rounded shadow-sm mx-auto d-block"
                    style="max-width: 450px; width: 100%; height: auto;" 
                    alt="{{ $pelatihan->nama }}">
            </div>

         {{-- Deskripsi --}}
            @php
                // Ambil konten mentah
                $konten = $pelatihan->konten;

                // Deteksi dan ubah daftar numerik menjadi <ol><li>...</li></ol>
                $konten = preg_replace_callback('/((?:\d+\.\s.*\n?)+)/', function ($matches) {
                    $listItems = '';
                    // Ambil setiap baris yang dimulai dengan angka
                    preg_match_all('/\d+\.\s+(.*)/', $matches[0], $items);
                    foreach ($items[1] as $item) {
                        $listItems .= '<li>' . trim($item) . '</li>';
                    }
                    return '<ol>' . $listItems . '</ol>';
                }, $konten);
            @endphp

            <div class="mb-5" style="text-align: justify;">
                {!! $konten !!}
            </div>

            {{-- Harga --}}
            <div class="row justify-content-center mb-4 text-center">
                <div class="col-md-11">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <strong>Biaya:</strong><br>
                        <h4 class="mb-0 text-success fw-bold">
                            <i class="bi bi-cash-stack me-1"></i> 
                            Rp {{ number_format($pelatihan->harga, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>

            {{-- Info Kuota --}}
            <div class="row mb-5 text-center">
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <strong>Terdaftar:</strong><br>
                        {{ $pelatihan->pendaftar()->where('status_validasi', 'valid')->count() }} orang
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <strong>Sisa Kuota:</strong><br>
                        {{ $pelatihan->kuota - $pelatihan->pendaftar()->where('status_validasi', 'valid')->count() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <strong>Status:</strong><br>
                        @if($pelatihan->kuota - $pelatihan->pendaftar()->where('status_validasi', 'valid')->count() > 0)
                            <span class="text-success fw-bold">Tersedia</span>
                        @else
                            <span class="text-danger fw-bold">Penuh</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form atau Status Pendaftaran --}}
            <div class="border-top pt-4">
                <br>

                @auth
                    @php
                        $jumlahPeserta = $pelatihan->pendaftar()->where('status_validasi', 'valid')->count();
                        $sisaKuota = $pelatihan->kuota - $jumlahPeserta;
                        $pendaftaranSaya = $pelatihan->pendaftar()->where('user_id', auth()->id())->first();
                        $batasPendaftaran = \Carbon\Carbon::parse($pelatihan->tanggal);
                        $now = \Carbon\Carbon::now();
                    @endphp

                    @if ($pendaftaranSaya)
                        @if ($pendaftaranSaya->status_validasi == 'pending')
                            <div class="alert alert-info text-center">
                                Anda sudah mendaftar. <strong>Menunggu validasi admin.</strong>
                            </div>
                        @elseif ($pendaftaranSaya->status_validasi == 'valid')
                            <div class="alert alert-success">
                                <h5 class="text-center mb-3">Anda telah <strong>Terdaftar</strong> Di Pelatihan Ini.</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input class="form-control" value="{{ $pendaftaranSaya->nama_lengkap }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" value="{{ $pendaftaranSaya->email }}" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input class="form-control" value="{{ $pendaftaranSaya->no_telp }}" readonly>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <label class="form-label">Instansi</label>
                                        <input class="form-control" value="{{ $pendaftaranSaya->instansi }}" readonly>
                                    </div>
                                </div>
                            </div>
                        @elseif ($pendaftaranSaya->status_validasi == 'tidak valid')
                            <div class="alert alert-danger text-center">
                                Pendaftaran Anda <strong>Tidak Valid</strong>. Silakan upload ulang bukti pembayaran.
                            </div>
                        @endif

                    @elseif ($sisaKuota <= 0)
                        <div class="text-center">
                            <button class="btn btn-danger btn-lg" disabled>Kuota Penuh</button>
                        </div>

                    @elseif ($now->greaterThan($batasPendaftaran))
                        <div class="alert alert-warning text-center">
                            <strong>Pendaftaran telah ditutup</strong><br>
                            Batas pendaftaran: {{ $batasPendaftaran->locale('id')->translatedFormat('d F Y') }}
                        </div>

                    @else
                        {{-- Form Pendaftaran --}}
                        <form action="{{ route('pelatihan.daftar', $pelatihan->id) }}" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" value="{{ auth()->user()->name }}" class="form-control" readonly>
                                </div>
                                <div class="col-md-6">  
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" readonly>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="no_telp" class="form-control" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Instansi</label>
                                    <select name="instansi" id="instansi-select" class="form-select" required>
                                        <option value="">-- Pilih Instansi --</option>
                                        <option value="Universitas Tarumanagara">Universitas Tarumanagara</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3" id="instansi-lainnya-div" style="display: none;">
                                    <label class="form-label">Instansi Lainnya</label>
                                    <input type="text" name="instansi_lain" class="form-control">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label class="form-label">Status / Pekerjaan</label>
                                    <select name="tipe_peserta" id="tipe-peserta-select" class="form-select" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="dosen">Dosen</option>
                                        <option value="mahasiswa">Mahasiswa</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mt-3" id="tipe-peserta-lain-div" style="display: none;">
                                    <label class="form-label">Status / Pekerjaan Lainnya</label>
                                    <input type="text" name="tipe_peserta_lain" class="form-control">
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle"></i> Daftar Sekarang
                                    </button>
                                </div>
                        @endif

                                <div class="text-center mt-4" style="background-color: blue; color: white; border: 5px dashed white; border-radius: 12px; padding: 20px;">
                                    <p>Pengunjung Hari ini : {{ $today }}</p>
                                    <p>Total Pengunjung : {{ number_format($total) }}</p>
                                </div>
                            </div>
                        </form>
                    

                @else
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Login untuk Daftar
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
   
document.addEventListener("DOMContentLoaded", function () {
    // === Untuk Instansi ===
    const instansiSelect = document.getElementById("instansi-select");
    const instansiLainDiv = document.getElementById("instansi-lainnya-div");
    const instansiLainInput = instansiLainDiv.querySelector("input");

    instansiSelect.addEventListener("change", function () {
        if (instansiSelect.value === "lainnya") {
            instansiLainDiv.style.display = "block";
            instansiLainInput.setAttribute("required", "required");
        } else {
            instansiLainDiv.style.display = "none";
            instansiLainInput.removeAttribute("required");
        }
    });

    // === Untuk Tipe Peserta ===
    const tipePesertaSelect = document.getElementById("tipe-peserta-select");
    const tipePesertaLainDiv = document.getElementById("tipe-peserta-lain-div");

    tipePesertaSelect.addEventListener("change", function () {
        if (tipePesertaSelect.value === "lainnya") {
            tipePesertaLainDiv.style.display = "block";
            tipePesertaLainDiv.querySelector("input").setAttribute("required", "required");
        } else {
            tipePesertaLainDiv.style.display = "none";
            tipePesertaLainDiv.querySelector("input").removeAttribute("required");
        }
    });

});
</script>
@endsection
