@extends('index')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-md-start">
        <i class="bi bi-journal-check me-2"></i>Pelatihan yang Anda Daftarkan
    </h2>

  <div class="mb-4 text-center text-md-start">
      <label for="filterStatus" class="form-label fw-semibold me-2">
          <i class="bi bi-funnel-fill me-1"></i>Filter Status:
      </label>
      <select id="filterStatus" class="form-select w-auto d-inline-block" onchange="filterPelatihan()">
          <option value="semua">Semua</option>
          <option value="belum-bayar">Belum Bayar</option>
          <option value="menunggu-validasi">Belum Tervalidasi</option>
          <option value="tervalidasi">Tervalidasi</option>
          <option value="selesai">Selesai</option>
      </select>
  </div>

    @if($pendaftaran->isEmpty())
        <p class="text-muted fst-italic">Anda belum mendaftar pelatihan apa pun.</p>
    @else
        <div class="list-group">
            @foreach($pendaftaran as $item)
                @php $pelatihan = $item->pelatihan;
                  
                  $statusClass = '';

                  if ($item->status_validasi === 'valid' && $item->sertifikat) {
                      $statusClass = 'selesai';
                  } elseif ($item->status_validasi === 'valid') {
                      $statusClass = 'tervalidasi';
                  } elseif (!$item->bukti_pembayaran) {
                      $statusClass = 'belum-bayar';
                  } else {
                      $statusClass = 'menunggu-validasi'; // jika sudah upload tapi belum divalidasi
                  }
              @endphp

                  <div class="list-group-item py-3 px-3 px-md-4 mb-3 rounded shadow-sm pelatihan-item {{ $statusClass }}">
        <div class="d-flex flex-column flex-md-row align-items-center gap-3">
            <img src="{{ asset('storage/' . $pelatihan->gambar) }}" alt="{{ $pelatihan->nama }}" class="rounded" style="width: 100px; height: 100px; object-fit: cover;">
            <div class="flex-grow-1 w-100">
                <h5 class="mb-1 text-center text-md-start">{{ $pelatihan->nama }}</h5>
                <p class="mb-1 text-secondary small text-center text-md-start">
                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($pelatihan->tanggal)->locale('id')->translatedFormat('d F Y') }}<br>
                    <i class="bi bi-tags me-1"></i>{{ $pelatihan->tag ?? '-' }}<br>
                    <i class="bi bi-people me-1"></i>Lokasi: {{ $pelatihan->lokasi ?? '-' }}
                </p>
            </div>

            <div class="text-center">
                @if($item->status_validasi === 'valid')
                    @if($item->sertifikat)
                        <span class="badge bg-primary mb-2 d-block">
                            <i class="bi bi-award-fill me-1"></i> Pelatihan Selesai
                        </span>
                        <button type="button" class="btn btn-info btn-sm w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#sertifikatModal" data-nama="{{ $pelatihan->nama }}" data-sertifikat="{{ $item->sertifikat }}">
                            <i class="bi bi-file-earmark-medical me-1"></i> Lihat Sertifikat
                        </button>
                    @else
                        <span class="badge bg-success d-block">
                            <i class="bi bi-check-circle-fill me-1"></i> Tervalidasi
                        </span>
                    @endif
                @else
                    @if($item->bukti_pembayaran)
                        <span class="badge bg-warning text-dark mb-2 d-block">
                            <i class="bi bi-clock-history me-1"></i> Bukti sudah dikirim
                        </span>
                        <button type="button" class="btn btn-secondary btn-sm w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="{{ $item->id }}">
                            <i class="bi bi-upload me-1"></i> Upload Ulang Bukti
                        </button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#uploadModal" data-id="{{ $item->id }}">
                            <i class="bi bi-upload me-1"></i> Upload Bukti Pembayaran
                        </button>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endforeach
        </div>
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
  <div class="modal-dialog modal-xl">
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
  var uploadModal = document.getElementById('uploadModal');
  uploadModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var pendaftaranId = button.getAttribute('data-id');
    uploadModal.querySelector('#pendaftaran_id').value = pendaftaranId;
  });

  var sertifikatModal = document.getElementById('sertifikatModal');
  sertifikatModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var namaPelatihan = button.getAttribute('data-nama');
    var sertifikat = button.getAttribute('data-sertifikat');
    sertifikatModal.querySelector('#judulPelatihan').textContent = namaPelatihan;
    sertifikatModal.querySelector('#sertifikatImage').src = "{{ asset('storage') }}/" + sertifikat;
    sertifikatModal.querySelector('#downloadLink').href = "{{ asset('storage') }}/" + sertifikat;
  });
  function filterPelatihan() {
    var selected = document.getElementById('filterStatus').value;
    var items = document.querySelectorAll('.pelatihan-item');

    items.forEach(function(item) {
        if (selected === 'semua') {
            item.style.display = '';
        } else {
            if (item.classList.contains(selected)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        }
    });
}
</script>
@endsection