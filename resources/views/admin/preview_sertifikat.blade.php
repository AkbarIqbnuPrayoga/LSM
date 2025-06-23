@extends('index')

@section('content')
    <div class="container py-4">
        <h4 class="mb-4"><i class="bi bi-eye-fill me-1"></i> Preview Sertifikat: {{ $pelatihan->nama }}</h4>

        <div class="row mb-4">
            <div class="col-md-auto mb-2">
                <a href="{{ route('admin') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>
            <div class="col-md-auto mb-2">
                <form method="POST" action="{{ route('admin.upload_kirim_sertifikat', $pelatihan->id) }}">
                    @csrf
                    <input type="hidden" name="action" value="kirim">
                    <input type="hidden" name="pos_x" value="{{ $pos_x }}">
                    <input type="hidden" name="pos_y" value="{{ $pos_y }}">
                    <input type="hidden" name="font_size" value="{{ $font_size }}">
                    <input type="hidden" name="font_color" value="{{ $font_color }}">
                    <input type="hidden" name="template_path" value="{{ $templatePath }}"> {{-- asalkan ini bisa diproses controller --}}

                    <button type="submit" class="btn btn-primary">Kirim Semua Sertifikat Sekarang</button>
                </form>

            </div>
        </div>


        @foreach ($pelatihan->pendaftar as $peserta)
            @if ($peserta->status_validasi === 'valid')
                <div class="mb-5 text-center">
                    <h5>{{ $peserta->user->name }}</h5>
                    <div style="position: relative; display: inline-block;">
                        <img src="{{ asset('storage/' . $templatePath) }}" class="img-fluid rounded shadow"
                            style="max-width: 800px;">
                        <div
                            style="
                    position: absolute;
                    left: {{ $pos_x }}px;
                    top: {{ $pos_y }}px;
                    transform: translate(-50%, -50%);
                    color: {{ $font_color }};
                    font-size: {{ $font_size }}px;
                    font-weight: bold;
                    white-space: nowrap;">
                            {{ $peserta->user->name }}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

    </div>
@endsection
