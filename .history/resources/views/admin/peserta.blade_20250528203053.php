@extends('index')

@section('content')
<div class="container mt-4">
    <h2>Peserta Pelatihan: {{ $pelatihan->nama }}</h2>
    <a href="{{ route('admin') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if($pelatihan->pendaftar->count() > 0)
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
                <th>Bukti Pembayaran</th>
                <th>Validasi</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
                <th>Notifikasi</th>
                <th><i class="bi bi-card-heading me-1"></i>Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelatihan->pendaftar as $index => $pendaftaran)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pendaftaran->user->name ?? 'Guest' }}</td>
                <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>

                {{-- Kolom Bukti Pembayaran --}}
                <td>
                    @if($pendaftaran->bukti_pembayaran)
                    <button type="button" class="btn btn-success btn-sm mb-1" data-bs-toggle="modal"
                        data-bs-target="#buktiModal{{ $pendaftaran->id }}">
                        Lihat Bukti
                    </button>

                    <!-- Modal Bukti Pembayaran -->
                    <div class="modal fade" id="buktiModal{{ $pendaftaran->id }}" tabindex="-1"
                        aria-labelledby="buktiModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="buktiModalLabel{{ $pendaftaran->id }}">Bukti Pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $pendaftaran->bukti_pembayaran) }}" class="img-fluid"
                                        alt="Bukti Pembayaran">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <span class="text-muted">Belum diunggah</span>
                    @endif
                </td>

                {{-- Kolom Validasi --}}
                <td>
                    @if($pendaftaran->bukti_pembayaran)
                    <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST"
                        class="d-flex flex-column gap-1">
                        @csrf
                        <input type="hidden" name="status" value="valid">
                        <button type="submit" class="btn btn-primary btn-sm">Valid</button>
                    </form>
                    <form action="{{ route('pendaftaran.validasi', $pendaftaran->id) }}" method="POST" class="mt-1">
                        @csrf
                        <input type="hidden" name="status" value="tidak valid">
                        <button type="submit" class="btn btn-warning btn-sm">Tidak Valid</button>
                    </form>
                    @else
                    <span class="text-muted">Tidak tersedia</span>
                    @endif
                </td>

                {{-- Kolom Status Pembayaran --}}
                <td>
                    @if($pendaftaran->status_validasi === 'valid')
                    <span class="badge bg-success">Valid</span>
                    @elseif($pendaftaran->status_validasi === 'tidak valid')
                    <span class="badge bg-danger">Tidak Valid</span>
                    @else
                    <span class="badge bg-secondary">Pending</span>
                    @endif
                </td>

                {{-- Kolom Aksi Hapus --}}
                <td>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $pendaftaran->id }}">
                        Hapus
                    </button>

                    <!-- Modal Hapus -->
                    <div class="modal fade" id="deleteModal{{ $pendaftaran->id }}" tabindex="-1"
                        aria-labelledby="deleteModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus peserta
                                    <strong>{{ $pendaftaran->user->name ?? 'Guest' }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                {{-- Kolom Notifikasi --}}
                <td>
                    <form action="{{ route('pendaftaran.kirim_notif', $pendaftaran->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm w-100">Kirim Notif</button>
                    </form>
                </td>

                {{-- Kolom Sertifikat --}}
                {{-- Kolom Sertifikat --}}
<td>
    @if($pendaftaran->sertifikat)
        <span class="badge bg-success">Terkirim</span>
        <a href="{{ asset('storage/sertifikat/' . $pendaftaran->sertifikat) }}" target="_blank" class="btn btn-sm btn-outline-success ms-2">
            <i class="bi bi-file-earmark-arrow-down"></i> Lihat
        </a>
    @else
        <button type="button" class="btn btn-sm btn-primary rounded" 
                data-bs-toggle="modal" 
                data-bs-target="#sertifikatModal" 
                data-pendaftaranid="{{ $pendaftaran->id }}">
            Kirim Sertifikat
        </button>
    @endif
</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div class="alert alert-info">Belum ada peserta yang mendaftar pelatihan ini.</div>
    @endif
</div>

<!-- Modal Kirim Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('sertifikat.kirim') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <input type="hidden" name="pendaftaran_id" id="modalPendaftaranId">
            <div class="modal-header">
                <h5 class="modal-title" id="sertifikatModalLabel">Unggah Sertifikat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="sertifikat" class="form-label">Upload Sertifikat (jpg/png/pdf)</label>
                    <input type="file" class="form-control" name="sertifikat" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Kirim Sertifikat</button>
            </div>
        </form>
    </div>
</div>

{{-- Script untuk input pelatihan_id otomatis ke modal --}}
<script>
    const sertifikatModal = document.getElementById('sertifikatModal');
    sertifikatModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const pendaftaranId = button.getAttribute('data-pendaftaranid');
        const inputPendaftaran = sertifikatModal.querySelector('#modalPendaftaranId');
        inputPendaftaran.value = pendaftaranId;
    });
    const sertifikatModal = document.getElementById('sertifikatModal');
    sertifikatModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const pendaftaranId = button.getAttribute('data-pendaftaranid');
    const inputId = sertifikatModal.querySelector('#modalPendaftaranId');
    inputId.value = pendaftaranId;
    });
</script>
@endsection
