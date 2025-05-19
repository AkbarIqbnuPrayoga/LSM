@extends('index')

@section('content')
<div class="container mt-4">
    <h2>Peserta Pelatihan: {{ $pelatihan->nama }}</h2>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Kembali</a>

    @if($pelatihan->pendaftar->count() > 0)
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelatihan->pendaftar as $index => $pendaftaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pendaftaran->user->name ?? 'Guest' }}</td>
                    <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                    <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-info">Belum ada peserta yang mendaftar pelatihan ini.</div>
    @endif
</div>
@endsection
