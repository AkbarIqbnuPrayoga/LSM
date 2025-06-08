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
                        <span class="text-capitalize">{{ $pelatihan->tag }}</span>
                    </div>
                </div>

                {{-- Tanggal & Waktu --}}
                <div class="col-md-5 mb-3">
                    <div class="border rounded p-3 bg-light h-100">
                        <strong>Tanggal:</strong><br>
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d M Y') }}
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
                     class="img-fluid rounded shadow-sm"
                     style="max-width: 450px; height: auto;" 
                     alt="{{ $pelatihan->nama }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-5" style="text-align: justify;">
                {!! $pelatihan->konten !!}
            </div>

            {{-- Harga --}}
            <div class="row justify-content-center mb-4 text-center">
                <div class="col-md-11">
                    <div class="bg-light p-3 rounded shadow-sm">
                        <strong>Harga:</strong><br>
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
                    @else
                        {{-- Cek apakah waktu pelatihan sudah dimulai atau selesai --}}
                        @php
                            $now = \Carbon\Carbon::now();
                            $waktuMulai = \Carbon\Carbon::parse($pelatihan->tanggal . ' ' . $pelatihan->waktu_mulai);
                        @endphp
                        
                        @if ($now->greaterThanOrEqualTo($waktuMulai))
                            <div class="text-center">
                                <div class="alert alert-danger">
                                    Pelatihan ini sudah <strong>dimulai</strong>. Pendaftaran sudah ditutup.
                                </div>
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
                                    <div class="col-md-6 mt-3" id="tipe_peserta_div" style="display: none;">
    <label class="form-label">Tipe Peserta</label>
    <select name="tipe_peserta" id="tipe_peserta" class="form-select">
        <option value="">-- Pilih Tipe --</option>
        <option value="Dosen">Dosen</option>
        <option value="Mahasiswa">Mahasiswa</option>
        <option value="lainnya">Lainnya</option>
    </select>
</div>

<div class="col-md-6 mt-3" id="tipe_peserta_lain_div" style="display: none;">
    <label class="form-label">Tipe Peserta Lainnya</label>
    <input type="text" name="tipe_peserta_lain" id="tipe_peserta_lain" class="form-control">
</div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check-circle"></i> Daftar Sekarang
                                    </button>
                                </div>

                                <div class="text-center mt-4" style="background-color: blue; color: white; border: 5px dashed white; border-radius: 12px; padding: 20px;">
                                    <p>Pengunjung Hari ini : {{ $today }}</p>
                                    <p>Total Pengunjung : {{ number_format($total) }}</p>
                                </div>
                            </form>
                        @endif
                    @endif
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
    const kategori = document.getElementById("kategori_instansi");
    const tipeDiv = document.getElementById("tipe_peserta_div");
    const universitasDiv = document.getElementById("universitas_div");
    const tipe = document.getElementById("tipe_peserta");
    const univ = document.getElementById("universitas_eksternal");
    const tipeLainDiv = document.getElementById("tipe_peserta_lain_div");
    const tipeLainInput = document.getElementById("tipe_peserta_lain");

    kategori.addEventListener("change", function () {
        const val = this.value;

        if (val === "Internal Untar") {
            tipeDiv.style.display = "block";
            universitasDiv.style.display = "none";
            tipe.setAttribute("required", "required");
            univ.removeAttribute("required");
            univ.value = "";
        } else if (val === "Eksternal Luar Untar") {
            tipeDiv.style.display = "block";
            universitasDiv.style.display = "block";
            tipe.setAttribute("required", "required");
            univ.setAttribute("required", "required");
        } else {
            tipeDiv.style.display = "none";
            universitasDiv.style.display = "none";
            tipe.removeAttribute("required");
            univ.removeAttribute("required");
            tipe.value = "";
            univ.value = "";
        }
    });

    tipe.addEventListener("change", function () {
        if (this.value === "lainnya") {
            tipeLainDiv.style.display = "block";
            tipeLainInput.setAttribute("required", "required");
        } else {
            tipeLainDiv.style.display = "none";
            tipeLainInput.removeAttribute("required");
            tipeLainInput.value = "";
        }
    });
});
</script>
@endsection
