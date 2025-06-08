@extends('index')

@section('content')
<div class="container mt-4 p-4 bg-white shadow rounded">
    <h4 class="mb-3">
        <i class="bi bi-people-fill me-2"></i>Peserta Pelatihan: {{ $pelatihan->nama }}
    </h4>

    <div class="d-flex mb-3 gap-2">
        <a href="{{ route('admin') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
        </a>
        <a href="{{ route('admin.download.bukti', $pelatihan->id) }}" class="btn btn-success">
            <i class="bi bi-download me-1"></i> Download Semua Bukti
        </a>
    </div>

    @if($pelatihan->pendaftar->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Instansi</th>
                    <th><i class="bi bi-calendar"></i> Daftar</th>
                    <th><i class="bi bi-cash-coin"></i> Harga</th>
                    <th><i class="bi bi-image"></i> Bukti</th>
                    <th><i class="bi bi-check2-circle"></i> Validasi</th>
                    <th>Status</th>
                    <th><i class="bi bi-trash"></i> Hapus</th>
                    <th><i class="bi bi-bell"></i> Notifikasi</th>
                    <th><i class="bi bi-award"></i> Sertifikat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelatihan->pendaftar as $index => $pendaftaran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pendaftaran->user->name ?? 'Guest' }}</td>
                    <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                    
                    <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>
                    <td>Rp {{ number_format($pelatihan->harga, 0, ',', '.') }}</td>

                    <td class="text-center">
                        @if($pendaftaran->bukti_pembayaran)
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#buktiModal{{ $pendaftaran->id }}">
                            <i class="bi bi-eye"></i> Lihat
                        </button>
                        @else
                        <span class="text-muted">Belum</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($pendaftaran->bukti_pembayaran)
                        <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="valid">
                            <button class="btn btn-sm btn-primary" title="Valid"><i class="bi bi-check-lg"></i></button>
                        </form>
                        <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="tidak valid">
                            <button class="btn btn-sm btn-warning" title="Tidak Valid"><i class="bi bi-x-lg"></i></button>
                        </form>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($pendaftaran->status_validasi === 'valid')
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Valid</span>
                        @elseif($pendaftaran->status_validasi === 'tidak valid')
                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Tidak</span>
                        @else
                        <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pendaftaran->id }}">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </td>

                    <td class="text-center">
                        <form action="{{ route('pendaftaran.kirim_notif', $pendaftaran->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-info w-100">
                                <i class="bi bi-send"></i> Kirim
                            </button>
                        </form>
                    </td>

                    <td class="text-center">
                        @if ($pendaftaran->sertifikat)
                        <span class="badge bg-success"><i class="bi bi-check-circle-fill"></i></span>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-secondary ms-1"
                        data-bs-toggle="modal"
                        data-bs-target="#modalLihatSertifikat"
                        data-fileurl="{{ asset('storage/' . $pendaftaran->sertifikat) }}">
                        <i class="bi bi-eye"></i> Lihat
                        </a>
                        @else
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#sertifikatModal" data-pendaftaranid="{{ $pendaftaran->id }}">
                            <i class="bi bi-upload"></i> Kirim
                        </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal Bukti -->
                <div class="modal fade" id="buktiModal{{ $pendaftaran->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Bukti Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="{{ asset('storage/' . $pendaftaran->bukti_pembayaran) }}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Hapus -->
                <div class="modal fade" id="deleteModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg-white shadow-sm border-0">
                            <form method="POST" action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}">
                                @csrf
                                @method('DELETE')

                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $pendaftaran->id }}">
                                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Konfirmasi Penghapusan
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>

                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus peserta
                                    <strong>{{ $pendaftaran->user->name ?? 'Guest' }}</strong> dari pelatihan ini?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info"><i class="bi bi-info-circle me-1"></i> Belum ada peserta yang mendaftar.</div>
    @endif
</div>

<!-- Modal Lihat Sertifikat -->
<div class="modal fade" id="modalLihatSertifikat" tabindex="-1" aria-labelledby="modalLihatSertifikatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">  <!-- modal-lg supaya lebih lebar -->
        <div class="modal-content bg-white shadow-sm border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLihatSertifikatLabel">
                    <i class="bi bi-file-earmark-text me-2"></i>Lihat Sertifikat
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body text-center">
                <div id="sertifikatContainer">
                    <!-- Konten sertifikat akan dimasukkan via JS -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('sertifikat.kirim') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="pendaftaran_id" id="modalPendaftaranId">
            <div class="modal-header">
                <h5 class="modal-title">Upload Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">File Sertifikat</label>
                    <input type="file" class="form-control" name="sertifikat" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill me-1"></i>Kirim</button>
            </div>
        </form>
    </div>
</div>

<!-- Script isi ID otomatis -->
<script>
    const sertifikatModal = document.getElementById('sertifikatModal');
    sertifikatModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const pendaftaranId = button.getAttribute('data-pendaftaranid');
        const input = sertifikatModal.querySelector('#modalPendaftaranId');
        input.value = pendaftaranId;
    });
    const modalLihatSertifikat = document.getElementById('modalLihatSertifikat');
    modalLihatSertifikat.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const fileUrl = button.getAttribute('data-fileurl');
        const container = modalLihatSertifikat.querySelector('#sertifikatContainer');

        const extension = fileUrl.split('.').pop().toLowerCase();
        let contentHtml = '';

        if (['jpg', 'jpeg', 'png'].includes(extension)) {
            contentHtml = `<img src="${fileUrl}" class="img-fluid rounded shadow-sm" alt="Sertifikat">`;
        } else if (extension === 'pdf') {
            contentHtml = `<iframe src="${fileUrl}" width="100%" height="600px" frameborder="0"></iframe>`;
        } else {
            contentHtml = `<p class="text-danger">File tidak dapat ditampilkan.</p>`;
        }

        container.innerHTML = contentHtml;
    });
</script>
@endsection
