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
        
        <div class="text-center mb-4">
            <img src="{{ asset('storage/' . $pelatihan->gambar) }}" 
                 class="img-fluid rounded"
                 style="max-width: 400px; height: auto;" 
                 alt="{{ $pelatihan->nama }}">
        </div>

        <div style="text-align: justify;" class="mb-4">
            {!! $pelatihan->konten !!}
        </div>

        {{-- Kotak Daftar Sekarang --}}
        <div class="border rounded p-4 bg-light shadow-sm text-center">
            <h4 class="mb-3">Tertarik dengan pelatihan ini?</h4>

            @auth
                <form action="{{ route('pelatihan.daftar', $pelatihan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg rounded">Daftar Sekarang</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded">Daftar Sekarang</a>
            @endauth
        </div>
    </div>
</div>
@endsection
