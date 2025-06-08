@extends('index')
@section('content')
<div class="container mt-5">
    <h2 class="mb-4"><i class="bi bi-journal-check me-2"></i>Pelatihan yang Anda Daftarkan</h2>

    @if($pendaftaran->isEmpty())
        <p class="text-muted fst-italic">Anda belum mendaftar pelatihan apa pun.</p>
    @else
        <ul class="list-group">
            @foreach($pendaftaran as $item)
                @php
                    $pelatihan = $item->pelatihan;
                @endphp
                <li class="list-group-item d-flex align-items-center justify-content-between" style="min-height: 140px;">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" alt="{{ $pelatihan->nama }}" 
                             class="rounded me-3" style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <h5 class="mb-1">{{ $pelatihan->nama }}</h5>
                            <p class="mb-1 text-secondary">
                                <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($pelatihan->tanggal)->locale('id')->translatedFormat('d F Y') }}<br>
                                <i class="bi bi-tags me-1"></i>{{ $pelatihan->tag ?? '-' }}<br>
                                <small class="text-muted"><i class="bi bi-people me-1"></i>Lokasi: {{ $pelatihan->lokasi ?? '-' }}</small>
                            </p>
                        </div>
                    </div>

                    <div class="text-center">
                        @if($item->status_validasi === 'valid')
                            @if($item->sertifikat)
                                <span class="badge bg-primary fs-6 mb-2">
                                    <i class="bi bi-award-fill me-1"></i>Pelatihan Telah Selesai
                                </span>
                                <br>
                                <button type="button" class="btn btn-info btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#sertifikatModal" 
                                    data-nama="{{ $pelatihan->nama }}" 
                                    data-sertifikat="{{ $item->sertifikat }}">
                                <i class="bi bi-file-earmark-medical me-1"></i> Lihat Sertifikat
                            </button>
                            @else
                                <span class="badge bg-success fs-6">
                                    <i class="bi bi-check-circle-fill me-1"></i>Tervalidasi
                                </span>
                            @endif
                        @else
                            <button type="button" class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#uploadModal" 
                                    data-id="{{ $item->id }}">
                                <i class="bi bi-upload me-1"></i> Upload Bukti Pembayaran
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
        <h5 class="modal-title" id="uploadModalLabel">
            <i class="bi bi-cloud-upload me-2"></i>Upload Bukti Pembayaran
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="pendaftaran_id" id="pendaftaran_id" value="">
          <div class="mb-3">
            <label for="bukti" class="form-label">
                <i class="bi bi-file-earmark-arrow-up me-1"></i>Pilih file bukti pembayaran (jpg/png/pdf):
            </label>
            <input class="form-control" type="file" id="bukti" name="bukti" required accept=".jpg,.jpeg,.png,.pdf">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-send-fill me-1"></i>Upload
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i>Batal
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Lihat Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl"> <!-- lebih besar tapi tidak centered -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sertifikatModalLabel">
            <i class="bi bi-award me-2"></i>Sertifikat Pelatihan
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body text-center">
        <h5 id="judulPelatihan" class="mb-3"></h5>
        <img id="sertifikatImage" src="" alt="Sertifikat" class="img-fluid rounded shadow-sm" style="max-height: 600px;">
        <br>
        <a id="downloadLink" href="#" download class="btn btn-success mt-3">
            <i class="bi bi-download me-1"></i> Unduh Sertifikat
        </a>
      </div>
    </div>
  </div>
</div>

<!-- Script Modal -->
<script>
  // Upload Modal: isi hidden input pendaftaran_id
  var uploadModal = document.getElementById('uploadModal');
  uploadModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var pendaftaranId = button.getAttribute('data-id');
    uploadModal.querySelector('#pendaftaran_id').value = pendaftaranId;
  });

  // Sertifikat Modal: isi judul, image, dan link download
  var sertifikatModal = document.getElementById('sertifikatModal');
  sertifikatModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var namaPelatihan = button.getAttribute('data-nama');
    var sertifikat = button.getAttribute('data-sertifikat');

    sertifikatModal.querySelector('#judulPelatihan').textContent = namaPelatihan;
    sertifikatModal.querySelector('#sertifikatImage').src = "{{ asset('storage') }}/" + sertifikat;
    sertifikatModal.querySelector('#downloadLink').href = "{{ asset('storage') }}/" + sertifikat;
  });
</script>
@endsection
