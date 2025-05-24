@extends('index')

@section('content')
<div class="container py-5">
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    <div class="card shadow p-4">
        <h2 class="mb-3 text-center">{{ $pelatihan->nama }}</h2>
        
        <p class="text-center mb-4"><strong>Tag:</strong> {{ ucfirst($pelatihan->tag) }}</p>
        <p class="text-center"><strong>Tanggal Pelatihan:</strong> {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d M Y') }}</p>
        
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $pelatihan->gambar) }}" 
                 class="img-fluid rounded"
                 style="max-width: 400px; height: auto;" 
                 alt="{{ $pelatihan->nama }}">
        </div>

        <div style="text-align: justify;" class="mb-4">
            {!! $pelatihan->konten !!}
            <p>Kuota: {{ $pelatihan->kuota }}</p>
            <p>Terdaftar: {{ $pelatihan->pendaftar()->count() }}</p>
            <p>Sisa Kuota: {{ $pelatihan->kuota - $pelatihan->pendaftar()->count() }}</p>
        </div>

        {{-- Kotak Daftar Sekarang --}}
        <div class="border rounded p-4 bg-light shadow-sm">
    <h4 class="mb-3 text-center">Tertarik dengan pelatihan ini?</h4>

    @auth
        @php
            $jumlahPeserta = $pelatihan->pendaftar()->count();
            $kuota = $pelatihan->kuota;
            $sisaKuota = $kuota - $jumlahPeserta;
        @endphp

        @if($sisaKuota <= 0)
            <div class="text-center">
                <button class="btn btn-secondary btn-lg rounded" disabled>Kuota Penuh</button>
            </div>
        @else
            <form action="{{ route('pelatihan.daftar', $pelatihan->id) }}" method="POST">
                @csrf

                {{-- Form Biodata --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="no_telp" class="form-label">No. Telepon</label>
                        <input type="text" id="no_telp" name="no_telp" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="instansi" class="form-label">Instansi</label>
                        <input type="text" id="instansi" name="instansi" class="form-control" required>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg rounded">Daftar Sekarang</button>
                </div>
            </form>
        @endif
    @else
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded">Login untuk Daftar</a>
        </div>
    @endauth
</div>
    </div>
</div>
@endsection
