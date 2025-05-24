@extends('index')
@section('content')
<div class="d-flex position-relative">
    {{-- Sidebar --}}
    <div class="bg text-white p-3 border-end position-relative" style="width: 250px; min-height: 100vh; border-radius: 0 10px 10px 0;" id="sidebar">
        <h5 class="text-white">Dashboard Admin</h5>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action rounded-2" onclick="showContent('tambahPelatihan')">Tambah Pelatihan</a>
            <a href="#" class="list-group-item list-group-item-action rounded-2" onclick="showContent('kelolaPelatihan')">Kelola Pelatihan</a>
            <a href="#" class="list-group-item list-group-item-action rounded-2" onclick="showContent('kelolaUser')">Kelola User</a>
            <a href="#" class="list-group-item list-group-item-action rounded-2" onclick="showContent('kuotaPelatihan')">Kuota Pelatihan</a>
            <a href="#" class="list-group-item list-group-item-action rounded-2" onclick="showContent('riwayatPelatihan')">Riwayat</a>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="flex-grow-1 p-4 bg-white">
        <main id="main" style="min-height: 100vh;">
            <div class="container">
                {{-- Tambah Pelatihan --}}
                <div id="tambahPelatihan" class="content-section" style="display: none;">
                    <h2 class="mb-4">Tambah Pelatihan</h2>
                    <form action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
                        @csrf
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control rounded" id="gambar" name="gambar" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pelatihan</label>
                            <input type="text" class="form-control rounded" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="kuota" class="form-label">Kuota Pelatihan</label>
                            <input type="number" class="form-control rounded" id="kuota" name="kuota" min="1" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tanggal" class="form-label">Tanggal Pelatihan</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control form-control-sm">
                        </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label">Isi Berita / Konten</label>
                            <textarea class="form-control rounded" id="konten" name="konten" rows="5" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tag:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="offline">
                                <label class="form-check-label">Offline</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="online">
                                <label class="form-check-label">Online</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tag[]" value="hybrid">
                                <label class="form-check-label">Hybrid</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary rounded">Simpan Pelatihan</button>
                    </form>
                </div>

                {{-- Kelola Pelatihan --}}
                <div id="kelolaPelatihan" class="content-section" style="display: none;">
                    <h2 class="mb-3">Kelola Pelatihan</h2>
                    <form action="{{ route('pelatihan.bulkDelete') }}" method="POST" id="bulkDeleteForm" class="p-3 border rounded shadow-sm bg-light">
                        @csrf @method('DELETE')
                        <table class="table table-bordered table-hover rounded">
                            <thead class="table-primary">
                                <tr>
                                    <th>Pilih</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Kuota</th> {{-- Tambah header Kuota --}}
                                    <th>Tag</th>
                                    <th>Tanggal Pelatihan</th>
                                    <th>Edit</th>
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
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->kuota }}</td> {{-- Tampilkan kuota --}}
                                        <td>{{ ucfirst($item->tag) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td><a href="{{ route('pelatihan.edit', $item->id) }}" class="btn btn-sm btn-warning rounded">Edit</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-danger rounded" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus Yang Dipilih</button>
                    </form>
                </div>

                    {{-- Modal Hapus --}}
                    <div class="modal fade" id="deleteModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded">
                                <div class="modal-header"><h5>Konfirmasi</h5></div>
                                <div class="modal-body">Apakah yakin ingin menghapus?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger" form="bulkDeleteForm">Ya, Hapus</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kelola User --}}
                <div id="kelolaUser" class="content-section" style="display: none;">
                    <h2 class="mb-3">Kelola User</h2>
                    <table class="table table-striped table-hover rounded shadow-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning rounded" onclick="openEditEmailModal({{ $user->id }}, '{{ $user->email }}')">Edit Email</button>
                                    <button class="btn btn-sm btn-info text-white rounded" onclick="openEditPasswordModal({{ $user->id }})">Ganti Password</button>
                                    @auth
                                        @if(auth()->user()->id !== $user->id)
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:none;">
                                                @csrf @method('DELETE')
                                            </form>
                                            <button class="btn btn-sm btn-danger rounded" onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">Hapus</button>
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
                        <h2 class="mb-4">Kuota Pelatihan</h2>
                        <div class="row">
                            @foreach($pelatihans as $pelatihan)
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" class="card-img-top" alt="Gambar Pelatihan" width="150" style="object-fit: contain;">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate" style="max-width: 100%;">{{ $pelatihan->nama }}</h5>
                                            <p class="card-text">Kuota: {{ $pelatihan->kuota }}</p>
                                            <p class="card-text">Sudah daftar: {{ $pelatihan->pendaftar_count ?? 0 }}</p>
                                            <p class="card-text">Tanggal Pelatihan: {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d-m-Y') }}</p>
                                            <a href="{{ route('admin.peserta', $pelatihan->id) }}" class="btn btn-primary">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- Riwayat Pelatihan --}}
                    <div id="riwayatPelatihan" class="content-section" style="display: none;">
                        <h2 class="mb-4">Riwayat Pelatihan</h2>
                        <div class="row">
                            @foreach($riwayatPelatihans as $pelatihan)
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <img src="{{ asset('storage/' . $pelatihan->gambar) }}" class="card-img-top" alt="Gambar Pelatihan" width="150" style="object-fit: contain;">
                                        <div class="card-body">
                                            <h5 class="card-title text-truncate" style="max-width: 100%;">{{ $pelatihan->nama }}</h5>
                                            <p class="card-text">Kuota: {{ $pelatihan->kuota }}</p>
                                            <p class="card-text">Tanggal Pelatihan: {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d-m-Y') }}</p>
                                            <p class="text-muted">Sudah dihapus</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    </script>
    @endsection
