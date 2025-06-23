@extends('index')

@section('content')
<div class="container mt-4 p-4 bg-white shadow rounded">
    <h4 class="mb-3">
        <i class="bi bi-people-fill me-2"></i>Peserta Pelatihan: {{ $pelatihan->nama }} <br>
        <i class="bi bi-cash-coin"></i> Biaya : Rp.{{ number_format($pelatihan->harga, 0, ',', '.') }}
    </h4>

  <div class="row mb-3">
        <div class="col-md-auto mb-2">
            <a href="{{ route('admin') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-left-circle me-1"></i> Kembali
            </a>
        </div>
        <div class="col-md-auto mb-2">
            <a href="{{ route('admin.download.bukti', $pelatihan->id) }}" class="btn btn-success w-100">
                <i class="bi bi-download me-1"></i> Download Bukti
            </a>
        </div>
        <div class="col-md-auto mb-2">
            <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#uploadTemplateModal">
                <i class="bi bi-upload me-1"></i> Upload & Kirim Sertifikat
            </button>
        </div>
        <div class="col-md-auto mb-2">
            <form action="{{ route('admin.kirim_notifikasi_semua', $pelatihan->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info w-100"
                        onclick="return confirm('Kirim notifikasi ke semua peserta pelatihan ini?')">
                    <i class="bi bi-send-check me-1"></i> Kirim Notifikasi
                </button>
            </form>
        </div>
    </div>
    <!-- Modal Upload Template Sertifikat -->
    <div class="modal fade" id="uploadTemplateModal" tabindex="-1" aria-labelledby="uploadTemplateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.upload_kirim_sertifikat', $pelatihan->id) }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadTemplateModalLabel">
                        <i class="bi bi-file-earmark-arrow-up me-1"></i> Upload Template & Kirim Sertifikat
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="template_file" class="form-label">File Template (PDF/Gambar)</label>
                        <input type="file" name="template_file" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    </div>
                    <div class="mb-3">
                        <label for="pos_x" class="form-label">Posisi X (dalam px)</label>
                        <input type="number" class="form-control" name="pos_x" required>
                    </div>
                    <div class="mb-3">
                        <label for="pos_y" class="form-label">Posisi Y (dalam px)</label>
                        <input type="number" class="form-control" name="pos_y" required>
                    </div>
                    <div class="mb-3">
                        <label for="font_size" class="form-label">Ukuran Font</label>
                        <input type="number" class="form-control" name="font_size" required>
                    </div>
                    <div class="mb-3">
                        <label for="font_color" class="form-label">Warna Font</label>
                        <input type="color" class="form-control form-control-color" name="font_color" value="#000000" title="Pilih warna font">
                    </div>
                    <div class="alert alert-info">
                        Pastikan template memiliki ruang kosong untuk nama peserta. Template akan digunakan untuk semua sertifikat.<br>
                        Setelah upload berhasil, sertifikat akan langsung dikirim ke semua peserta valid.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="generate" class="btn btn-warning">
                        <i class="bi bi-eye"></i> Generate & Preview
                    </button>
                    <button type="submit" name="action" value="kirim" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin mengirim sertifikat ke semua peserta valid?')">
                        <i class="bi bi-send"></i> Kirim Sertifikat
                    </button>
                </div>
            </form>
        </div>
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
                    <th>Status / Pekerjaan</th>
                    <th><i class="bi bi-calendar"></i> Daftar</th>
                    <th><i class="bi bi-image"></i> Bukti</th>
                    <th><i class="bi bi-check2-circle"></i> Validasi</th>
                    <th>Status</th>
                    <th><i class="bi bi-trash"></i> Hapus</th>
                    
                    <th><i class="bi bi-award"></i> Sertifikat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelatihan->pendaftar as $index => $pendaftaran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $pendaftaran->user->name ?? 'Guest' }}</td>
                    <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                    <td>{{ $pendaftaran->instansi ?? '-' }}</td>
                    <td>{{ $pendaftaran->tipe_peserta ?? '-' }}</td>
                    <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>

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
                        @php
                            // Nama file sertifikat sesuai format yang kamu buat di controller
                            $namaBersih = preg_replace('/[^A-Za-z0-9\-]/', '_', strtolower($pendaftaran->user->name ?? 'guest'));
                            $filename = 'sertifikat_' . $pelatihan->id . '_' . $namaBersih . '.jpg';
                            $filePath = 'storage/sertifikat/' . $filename;
                        @endphp

                        @if(Storage::disk('public')->exists('sertifikat/' . $filename))
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#lihatSertifikatModal{{ $pendaftaran->id }}">
                            <i class="bi bi-eye"></i> Lihat
                        </button>
                        @else
                        <span class="text-muted">Belum ada</span>
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
                <!-- Modal Lihat Sertifikat -->
                <div class="modal fade" id="lihatSertifikatModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="lihatSertifikatModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="lihatSertifikatModalLabel{{ $pendaftaran->id }}">
                                    Sertifikat: {{ $pendaftaran->user->name ?? 'Guest' }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body text-center">
                                @php
                                    $fileUrl = asset($filePath);
                                    $extension = pathinfo($fileUrl, PATHINFO_EXTENSION);
                                @endphp

                                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                                <img src="{{ $fileUrl }}" class="img-fluid rounded shadow-sm" alt="Sertifikat">
                                @elseif(strtolower($extension) === 'pdf')
                                <iframe src="{{ $fileUrl }}" width="100%" height="600px" frameborder="0"></iframe>
                                @else
                                <p class="text-danger">File sertifikat tidak dapat ditampilkan.</p>
                                @endif
                            </div>
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


<!-- Script isi ID otomatis -->
<script>
    document.querySelector('input[name="template_file"]').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert("Hanya gambar (.jpg/.jpeg/.png) yang bisa direkomendasikan posisi otomatis.");
            return;
        }

        const img = new Image();
        img.onload = function () {
            const width = img.width;
            const height = img.height;

            // Isi otomatis posisi X dan Y
            document.querySelector('input[name="pos_x"]').value = Math.floor(width / 2);
            document.querySelector('input[name="pos_y"]').value = Math.floor(height / 2) + 100;

            // Optional: Tampilkan rekomendasi ke user
            alert(`Ukuran gambar: ${width}x${height}px\nDisarankan:\nPos X = ${Math.floor(width / 2)}\nPos Y = ${Math.floor(height / 2) + 100}`);
        };

        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
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
