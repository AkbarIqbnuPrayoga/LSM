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
                    $sisaKuota = $pelatihan->kuota - ($pelatihan->pendaftar->count() ?? 0);
                @endphp
                <li class="list-group-item d-flex align-items-start justify-content-between" style="min-height: 150px;">
                    <div class="d-flex">
                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" alt="{{ $pelatihan->judul }}" 
                            style="width: 100px; height: 100px; object-fit: cover; margin-right: 20px; border-radius: 8px;">
                        <div>
                            <strong>{{ $pelatihan->nama }}</strong><br>
                            Tanggal: {{ $pelatihan->tanggal ?? '-' }}<br>
                            Tag: {{ $pelatihan->tag ?? '-' }}<br>
                            <small>Sisa Kuota: {{ $sisaKuota >= 0 ? $sisaKuota : 0 }}</small>
                        </div>
                    </div>

                    <!-- Status dan Tombol -->
                    <div class="text-center">
                            @if($item->status_validasi === 'valid')
                                @if($item->sertifikat)
                                    <span class="badge bg-primary fs-5">🎉 Pelatihan Telah Selesai</span>
                                    <br>
                                    <button class="btn btn-sm btn-info mt-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#sertifikatModal" 
                                        data-nama="{{ $pelatihan->nama }}" 
                                        data-sertifikat="{{ $item->sertifikat }}">
                                        🎓 Lihat Sertifikat
                                    </button>
                                @else
                                    <span class="badge bg-success fs-5">✅ Tervalidasi</span>
                                @endif
                            @else
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="{{ $item->id }}">
                                Upload Bukti Pembayaran
                            </button>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Modal Upload Bukti Pembayaran -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('bukti.upload') }}" enctype="multipart/form-data" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="uploadModalLabel">Upload Bukti Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="pendaftaran_id" id="pendaftaran_id" value="">
          <div class="mb-3">
            <label for="bukti" class="form-label">Pilih file bukti pembayaran (jpg/png/pdf):</label>
            <input class="form-control" type="file" id="bukti" name="bukti" required accept=".jpg,.jpeg,.png,.pdf">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Upload</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Lihat Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sertifikatModalLabel">Sertifikat Pelatihan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <h5 id="judulPelatihan" class="mb-3"></h5>
        <img id="sertifikatImage" src="" alt="Sertifikat" class="img-fluid mb-3" style="max-height: 500px;">
        <br>
        <a id="downloadLink" href="#" download class="btn btn-success">⬇️ Unduh Sertifikat</a>
      </div>
    </div>
  </div>
</div>

<!-- Script Modal -->
<script>
  var uploadModal = document.getElementById('uploadModal');
  uploadModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var pendaftaranId = button.getAttribute('data-id');
    var inputId = uploadModal.querySelector('#pendaftaran_id');
    inputId.value = pendaftaranId;
  });

  var sertifikatModal = document.getElementById('sertifikatModal');
  sertifikatModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var namaPelatihan = button.getAttribute('data-nama');
    var sertifikat = button.getAttribute('data-sertifikat');

    var judulPelatihan = sertifikatModal.querySelector('#judulPelatihan');
    var image = sertifikatModal.querySelector('#sertifikatImage');
    var downloadLink = sertifikatModal.querySelector('#downloadLink');

    judulPelatihan.textContent = namaPelatihan;
    image.src = "{{ asset('storage') }}/" + sertifikat;
    downloadLink.href = "{{ asset('storage') }}/" + sertifikat;
  });
</script>
@endsection