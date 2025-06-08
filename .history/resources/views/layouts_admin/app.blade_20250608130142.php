@extends('index')
@section('content')
<div class="d-flex position-relative">
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="bg-white text-black vh-100 d-flex flex-column p-3" style="width: 250px;">
        <h5 class="text-black mb-3">Pelatihan</h5>
        <ul class="nav flex-column mb-4">
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-black d-flex align-items-center" onclick="showContent('tambahPelatihan')">
                    <i class='"bi bi-plus-circle me-2" me-2'></i> Tambah Pelatihan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-black d-flex align-items-center" onclick="showContent('kelolaPelatihan')">
                    <i class='bi bi-journal-text me-2'></i> Kelola Pelatihan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-black d-flex align-items-center" onclick="showContent('kuotaPelatihan')">
                    <i class='bx bx-bar-chart-alt me-2'></i> Kuota Pelatihan
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-black d-flex align-items-center" onclick="showContent('riwayatPelatihan')">
                    <i class='bx bx-history me-2'></i> Riwayat
                </a>
            </li>
        </ul>

        <h5 class="text-black mb-3">User</h5>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a href="#" class="nav-link text-black d-flex align-items-center" onclick="showContent('kelolaUser')">
                    <i class='bx bx-user me-2'></i> Kelola User
                </a>
            </li>
        </ul>
    </aside>

    {{-- Main Content --}}
    <div class="flex-grow-1 p-4 bg-white">
        <main id="main" class="w-100">
            <div class="container">
                {{-- Tambah Pelatihan --}}
                <div id="tambahPelatihan" class="content-section" style="display: none;">
                    <h4><i class="bi bi-plus-circle me-2"></i>Tambah Pelatihan</h4>
                    <form action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data" class="border p-3 rounded shadow-sm bg-light">
                        @csrf
                        <div class="mb-3">
                            <label for="gambar" class="form-label"><i class="bi bi-image me-1"></i>Gambar</label>
                            <input type="file" class="form-control rounded form-control-sm w-auto" id="gambar" name="gambar" accept="image/*" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label"><i class="bi bi-card-heading me-1"></i>Nama Pelatihan</label>
                            <input type="text" class="form-control rounded" id="nama" name="nama" required>
                        </div>
                        {{-- Input Harga Pelatihan (muncul setelah isi nama pelatihan) --}}
                        <div class="mb-3" id="hargaContainer" style="display: none;">
                            <label for="harga" class="form-label">
                                <i class="bi bi-cash-coin me-1"></i>Harga Pelatihan (Rp.)
                            </label>
                            <input type="number" class="form-control rounded form-control-sm w-auto" id="harga" name="harga" min="0" step="1000" required>
                        </div>
                        {{-- Input Nomor Rekening --}}
                        <div class="mb-3">
                            <label for="rekening" class="form-label">
                                <i class="bi bi-credit-card-2-front me-1"></i>Nomor Rekening Pelatihan
                            </label>
                            <input type="text" class="form-control rounded form-control-sm w-auto" id="rekening" name="rekening" required oninput="showAtasNama()">
                        </div>

                        {{-- Input Atas Nama Rekening (muncul setelah isi nomor rekening) --}}
                        <div class="mb-3" id="atasNamaContainer" style="display: none;">
                            <label for="atas_nama" class="form-label">
                                <i class="bi bi-person-badge me-1"></i>Atas Nama Rekening
                            </label>
                            <input type="text" class="form-control rounded form-control-sm w-auto" id="atas_nama" name="atas_nama" oninput="showBank()">
                        </div>

                        {{-- Input Nama Bank (muncul setelah isi atas nama) --}}
                        <div class="mb-3" id="bankContainer" style="display: none;">
                            <label for="bank" class="form-label">
                                <i class="bi bi-bank me-1"></i>Nama Bank
                            </label>
                            <input type="text" class="form-control rounded form-control-sm w-auto" id="bank" name="bank">
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label"><i class="bi bi-people-fill me-1"></i>Kuota Pelatihan</label>
                            <input type="number" class="form-control rounded form-control-sm w-auto" id="kuota" name="kuota" min="1" required>
                        </div>
                        <div class="mb-3 col-md-4">
                        <label for="tanggal_mulai" class="form-label">
                            <i class="bi bi-calendar-event me-1"></i>Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control form-control-sm w-auto">
                    </div>

                    <div class="mb-3 col-md-4">
                        <label for="tanggal_selesai" class="form-label">
                            <i class="bi bi-calendar-event me-1"></i>Tanggal Selesai
                        </label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control form-control-sm w-auto">
                    </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label"><i class="bi bi-text-left me-1"></i>Isi Berita / Konten</label>
                            <textarea class="form-control rounded" id="konten" name="konten" rows="5" required></textarea>
                        </div>
                        {{-- Waktu Mulai --}}
                        <div class="mb-3 col-md-4">
                            <label for="waktu_mulai" class="form-label">
                                <i class="bi bi-clock-history me-1"></i>Waktu Mulai Pelatihan
                            </label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control form-control-sm w-auto" required>
                        </div>

                        {{-- Waktu Selesai --}}
                        <div class="mb-3 col-md-4">
                            <label for="waktu_selesai" class="form-label">
                                <i class="bi bi-clock me-1"></i>Waktu Selesai Pelatihan
                            </label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control form-control-sm w-auto" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-tags me-1"></i>Tag:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="offline" id="tagOffline" onchange="selectOnlyThis(this)">
                                <label class="form-check-label" for="tagOffline">Offline</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="online" id="tagOnline" onchange="selectOnlyThis(this)">
                                <label class="form-check-label" for="tagOnline">Online</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="hybrid" id="tagHybrid" onchange="selectOnlyThis(this)">
                                <label class="form-check-label" for="tagHybrid">Hybrid</label>
                            </div>
                        </div>

                        {{-- Dynamic Input Fields --}}
                        <div id="lokasiField" class="mb-3" style="display: none;">
                            <label for="lokasi" class="form-label"><i class="bi bi-geo-alt me-1"></i>Lokasi Pelatihan</label>
                            <input type="text" class="form-control rounded" id="lokasi" name="lokasi">
                        </div>

                        <div id="zoomField" class="mb-3" style="display: none;">
                            <label for="zoom_link" class="form-label"><i class="bi bi-link-45deg me-1"></i>Link Zoom Pelatihan</label>
                            <input type="url" class="form-control rounded" id="zoom_link" name="zoom_link">
                        </div>


                    <button type="submit" class="btn btn-primary rounded">Simpan Pelatihan</button>
                </form>
            </div>

           {{-- Kelola Pelatihan --}}
            <div id="kelolaPelatihan" class="content-section" style="display: none;">
                <h4><i class="bi bi-journal-text me-2"></i>Kelola Pelatihan</h4>

                <form method="POST" id="bulkActionForm" class="p-3 border rounded shadow-sm bg-light">
                    @csrf
                    <!-- ini akan diganti JS dengan DELETE jika hapus -->
                    <table class="table table-striped align-middle">
                        <thead class="table-secondary">
                            <tr>
                                <th>Pilih</th>
                                <th><i class="bi bi-card-heading me-1"></i>Gambar</th>
                                <th><i class="bi bi-card-heading me-1"></i>Nama</th>
                                <th><i class="bi bi-text-left me-1"></i>Kuota</th>
                                <th><i class="bi bi-text-left me-1"></i>Tag</th>
                                <th><i class="bi bi-calendar-event me-1"></i>Tanggal Pelatihan</th>
                                <th><i class="bi bi-card-heading me-1"></i>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pelatihan as $item)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="form-check d-flex justify-content-center align-items-center" style="height: 100%;">
                                            <input type="checkbox" class="form-check-input" style="transform: scale(1.5);" name="ids[]" value="{{ $item->id }}">
                                        </div>
                                    </td>
                                    <td><img src="{{ asset('storage/' . $item->gambar) }}" width="100" class="rounded"></td>
                                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $item->nama }}">
                                        {{ $item->nama }}
                                    </td>
                                    <td>{{ $item->kuota }}</td>
                                    <td>{{ ucfirst($item->tag) }}</td>
                                    <td>
    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d-m-Y') }}
    s/d
    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d-m-Y') }}
</td>
                                    <td><a href="{{ route('pelatihan.edit', $item->id) }}" class="btn btn-sm btn-primary rounded">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tombol buka modal hapus -->
                    <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Yang Dipilih</button>

                    <!-- Tombol buka modal tambah ke riwayat -->
                    <button type="button" class="btn btn-secondary rounded" data-bs-toggle="modal" data-bs-target="#riwayatModal">
                        Tambah ke Riwayat
                    </button>
                </form>
            </div>

                {{-- Modal hapus Pelatihan --}}
                <div class="modal fade" id="deleteModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content rounded">
                            <div class="modal-header"><h5>Konfirmasi</h5></div>
                            <div class="modal-body">Apakah yakin ingin menghapus?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" onclick="setDeleteAction()">Ya, Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Konfirmasi Tambah ke Riwayat -->
                <div class="modal fade" id="riwayatModal" tabindex="-1" aria-labelledby="riwayatModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="riwayatModalLabel">Konfirmasi Tambah ke Riwayat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin memindahkan pelatihan yang dipilih ke riwayat?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>

                        {{-- Submit ke route pindah ke riwayat --}}
                        <form id="formTambahRiwayat" method="POST" action="{{ route('pelatihan.addToRiwayat') }}">
                            @csrf
                            {{-- Salin checkbox terpilih lewat JS --}}
                            <div id="hiddenCheckboxesRiwayat"></div>
                            <button type="submit" class="btn btn-secondary">Ya, Pindahkan</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>

                    

                {{-- Kelola User --}}
                <div id="kelolaUser" class="content-section" style="display: none;">
                    <h4><i class="bi bi-people me-2"></i>Kelola User</h4>
                    <table class="table table-striped align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="bi bi-person me-1"></i>Nama</th>
                                <th><i class="bi bi-envelope me-1"></i>Email</th>
                                <th><i class="bi bi-clock me-1"></i>Terdaftar</th>
                                <th><i class="bi bi-gear me-1"></i>Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @auth
                                        @if(auth()->user()->id !== $user->id)
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:none;" class="d-inline">
                                                @csrf @method('DELETE')
                                            </form>
                                            <button class="btn btn-sm btn-danger btn-sm rounded" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')"><i class="bi bi-trash me-1"></i>Hapus</button>
                                        @else   
                                            <span class="text-muted"></span>
                                        @endif
                                    @endauth
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Modal Ganti Email --}}
                    <div class="modal fade" id="editEmailModal" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="" id="editEmailForm">
                                @csrf @method('PUT')
                                <div class="modal-content rounded">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ganti Email</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Baru</label>
                                            <input type="email" name="email" id="emailInput" class="form-control rounded" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary rounded">Simpan</button>
                                        <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Modal Ganti Password --}}
                    <div class="modal fade" id="editPasswordModal" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST" action="" id="editPasswordForm">
                                @csrf @method('PUT')
                                <div class="modal-content rounded">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Ganti Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password Baru</label>
                                            <input type="password" name="password" class="form-control rounded" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation" class="form-control rounded" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary rounded">Simpan</button>
                                        <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Modal Konfirmasi Hapus User --}}
                    <div class="modal fade" id="deleteUserModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded">
                                <div class="modal-header">
                                    <h5 class="modal-title">Konfirmasi Hapus User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus user <strong id="userNameToDelete"></strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-danger rounded" id="confirmDeleteBtn">Ya, Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    {{-- Kuota Pelatihan --}}
                    <div id="kuotaPelatihan" class="content-section" style="display: none;">
                        <h4><i class='bx bx-bar-chart-alt me-2'></i>Kuota Pelatihan</h4>
                        <div class="row">
                            @foreach($pelatihans as $pelatihan)
                                <div class="col-md-4 mb-3">
                                    <div class="card mb-4 shadow-sm">
                                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" class="card-img-top" alt="Gambar Pelatihan" width="200" style="object-fit: contain; height: 250px;">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="bi bi-bookmark-star me-1"></i>{{ $pelatihan->nama }}</h5>
                                            <p class="card-text"><i class="bi bi-people-fill me-1"></i>Kuota: {{ $pelatihan->kuota }}</p>
                                            <p class="card-text">Sudah daftar: {{ $pelatihan->pendaftar_count ?? 0 }}</p>
                                            <p class="card-text">Tanggal Pelatihan: {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d-m-Y') }}</p>
                                            <a href="{{ route('admin.peserta', $pelatihan->id) }}" class="btn btn-primary">
                                                <i class="bi bi-eye me-1"></i>Lihat
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>  
                    {{-- Riwayat Pelatihan --}}
                    <div id="riwayatPelatihan" class="content-section" style="display: none;">
                        <h4><i class="bi bi-clock-history me-2"></i>Riwayat Pelatihan</h4>
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th><i class="bi bi-card-heading me-1"></i>Nama Pelatihan</th>
                                        <th><i class="bi bi-calendar-event me-1"></i>Tanggal</th>
                                        <th><i class="bi bi-tags me-1"></i>Tag</th>
                                        <th><i class="bi bi-geo-alt me-1"></i>Lokasi</th>
                                        <th><i class="bi bi-lock me-1"></i>Pendaftaran</th>
                                        <th><i class="bi bi-trash me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatPelatihans as $pelatihan)
                                        <tr>
                                            <td>{{ $pelatihan->nama }}</td>
                                            <td>{{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ ucfirst($pelatihan->tag) }}</td>
                                            <td>{{ $pelatihan->lokasi ?? '-' }}</td>
                                            <td><span class="badge bg-secondary">Tutup</span></td>
                                            <td>
                                                <form action="{{ route('riwayatPelatihan.destroy', $pelatihan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pelatihan ini dari riwayat?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Tombol Hapus memicu modal -->
                                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusRiwayat" onclick="setRiwayatDelete({{ $pelatihan->id }})">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">Belum ada riwayat pelatihan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Modal Hapus Riwayat -->
                    <div class="modal fade" id="modalHapusRiwayat" tabindex="-1" aria-labelledby="modalHapusRiwayatLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-4">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalHapusRiwayatLabel">Konfirmasi Hapus Riwayat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus pelatihan ini dari riwayat?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>

                            <!-- Form delete akan di-set via JavaScript -->
                            <form id="formHapusRiwayat" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

            </div>
        </main>
    </div>
</div>

    {{-- JavaScript: show/hide konten --}}
    <script>
        function showContent(id) {
            // sembunyikan semua konten
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.style.display = 'none';
            });

            // tampilkan konten sesuai id
            const activeSection = document.getElementById(id);
            if(activeSection) {
                activeSection.style.display = 'block';
            }
        }

        // Tampilkan konten pertama saat halaman load (misal: Tambah Pelatihan)
        document.addEventListener('DOMContentLoaded', function () {
            showContent('tambahPelatihan');
        });
            let userIdToDelete = null;

        function confirmDelete(userId, userName) {
            userIdToDelete = userId;
            // Set nama user di modal
            document.getElementById('userNameToDelete').textContent = userName;

            // Tampilkan modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));
            deleteModal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (userIdToDelete) {
                // Submit form hapus user sesuai id
                document.getElementById('delete-form-' + userIdToDelete).submit();
            }
        });
            function openEditEmailModal(id, email) {
            const form = document.getElementById('editEmailForm');
            form.action = '/admin/users/' + id + '/edit';
            document.getElementById('emailInput').value = email;
            const emailModal = new bootstrap.Modal(document.getElementById('editEmailModal'));
            emailModal.show();
        }

        function openEditPasswordModal(id) {
            const form = document.getElementById('editPasswordForm');
            form.action = '/admin/users/' + id + '/password';
            const passwordModal = new bootstrap.Modal(document.getElementById('editPasswordModal'));
            passwordModal.show();
        }
        document.addEventListener('DOMContentLoaded', function () {
            const kuotaBtn = document.querySelector('a[onclick="showContent(\'kuotaPelatihan\')"]');
            if (kuotaBtn) {
                kuotaBtn.addEventListener('click', function(e) {
                    e.preventDefault();  // supaya tidak reload halaman
                    showKuotaPelatihan();
                });
            }
        });
        function setDeleteAction() {
                const form = document.getElementById('bulkActionForm');

                // Ubah action ke route hapus
                form.action = "{{ route('pelatihan.bulkDelete') }}";

                // Tambah method spoofing DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                methodInput.id = 'deleteMethod';

                // Hapus yang lama jika ada
                const existing = document.getElementById('deleteMethod');
                if (existing) existing.remove();

                form.appendChild(methodInput);
                form.submit();
            }

        function submitToRiwayat() {
            const form = document.getElementById('bulkActionForm');

            // Hapus method spoofing jika ada
            const method = document.getElementById('deleteMethod');
            if (method) method.remove();

            // Ubah action ke tambah ke riwayat
            form.action = "{{ route('pelatihan.addToRiwayat') }}";
            form.method = "POST";

            form.submit();
        }
         // Saat modal "Tambah ke Riwayat" dibuka, salin checkbox dari form utama
        const bulkForm = document.getElementById('bulkActionForm');
        const formRiwayat = document.getElementById('formTambahRiwayat');
        const hiddenContainer = document.getElementById('hiddenCheckboxesRiwayat');

        document.getElementById('riwayatModal').addEventListener('show.bs.modal', function () {
            // Kosongkan isian lama
            hiddenContainer.innerHTML = '';

            // Ambil semua checkbox yang dicek dari form utama
            bulkForm.querySelectorAll('input[name="ids[]"]:checked').forEach(function (checkbox) {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'ids[]';
                hiddenInput.value = checkbox.value;
                hiddenContainer.appendChild(hiddenInput);
            });
        });
        function setRiwayatDelete(id) {
            const form = document.getElementById('formHapusRiwayat');
            form.action = `/admin/riwayat/${id}`;
        }
        function selectOnlyThis(checkbox) {
                const checkboxes = document.querySelectorAll('input[name="tag[]"]');
                checkboxes.forEach((cb) => {
                    if (cb !== checkbox) cb.checked = false;
                });
                handleTagChange(); // Update input tampilannya
            }

            function handleTagChange() {
                const offline = document.getElementById('tagOffline').checked;
                const online = document.getElementById('tagOnline').checked;
                const hybrid = document.getElementById('tagHybrid').checked;

                document.getElementById('lokasiField').style.display = 'none';
                document.getElementById('zoomField').style.display = 'none';

                if (offline) {
                    document.getElementById('lokasiField').style.display = 'block';
                } else if (online) {
                    document.getElementById('zoomField').style.display = 'block';
                } else if (hybrid) {
                    document.getElementById('lokasiField').style.display = 'block';
                    document.getElementById('zoomField').style.display = 'block';
                }
            }

            function showAtasNama() {
                const rekening = document.getElementById('rekening').value.trim();
                const atasNamaContainer = document.getElementById('atasNamaContainer');
                atasNamaContainer.style.display = rekening ? 'block' : 'none';

                // Jika rekening dihapus, sembunyikan input selanjutnya
                if (!rekening) {
                    document.getElementById('bankContainer').style.display = 'none';
                    document.getElementById('atas_nama').value = '';
                    document.getElementById('bank').value = '';
                }
            }

            function showBank() {
                const atasNama = document.getElementById('atas_nama').value.trim();
                const bankContainer = document.getElementById('bankContainer');
                bankContainer.style.display = atasNama ? 'block' : 'none';

                // Jika atas nama dihapus, sembunyikan nama bank
                if (!atasNama) {
                    document.getElementById('bank').value = '';
                }
            }
            const namaInput = document.getElementById('nama');
            const hargaContainer = document.getElementById('hargaContainer');

            namaInput.addEventListener('input', function () {
                if (namaInput.value.trim() !== "") {
                    hargaContainer.style.display = 'block';
                } else {
                    hargaContainer.style.display = 'none';
                }
            });
    </script>
    @endsection
