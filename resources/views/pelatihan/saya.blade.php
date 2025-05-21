@extends('index')
@section('content')
<div class="container mt-5">
    <h2>Pelatihan yang Anda Daftarkan</h2>

    @if($pendaftaran->isEmpty())
        <p>Anda belum mendaftar pelatihan apa pun.</p>
    @else
        <ul class="list-group">
            @foreach($pendaftaran as $item)
                @php
                    $pelatihan = $item->pelatihan;
                    // Contoh hitung sisa kuota jika kamu punya relasi pendaftar
                    $sisaKuota = $pelatihan->kuota - ($pelatihan->pendaftar->count() ?? 0);
                @endphp
                    <li class="list-group-item d-flex align-items-start" style="min-height: 150px;">
                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" alt="{{ $pelatihan->judul }}" 
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px; border-radius: 8px;">
                        <div>
                            <strong>{{ $pelatihan->nama }}</strong><br>
                            Tanggal: {{ $pelatihan->tanggal ?? '-' }}<br>
                            Lokasi: {{ $pelatihan->lokasi ?? '-' }}<br>
                            <small>Sisa Kuota: {{ $sisaKuota >= 0 ? $sisaKuota : 0 }}</small>
                        </div>
                    </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
