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
                <th>Aksi</th>
                <th>Notifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pelatihan->pendaftar as $index => $pendaftaran)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pendaftaran->user->name ?? 'Guest' }}</td>
                    <td>{{ $pendaftaran->user->email ?? '-' }}</td>
                    <td>{{ $pendaftaran->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <!-- Tombol buka modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $pendaftaran->id }}">
                            Hapus
                        </button>

                        <!-- Modal Konfirmasi -->
                        <div class="modal fade" id="deleteModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $pendaftaran->id }}">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                              </div>
                              <div class="modal-body">
                                Apakah Anda yakin ingin menghapus peserta <strong>{{ $pendaftaran->user->name ?? 'Guest' }}</strong>?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('pendaftaran.destroy', $pendaftaran->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                    <td>
                    <!-- Tombol Kirim Notif -->
                    <form action="{{ route('pendaftaran.kirim_notif', $pendaftaran->id) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn btn-info btn-sm w-100">Kirim Notif</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <div class="alert alert-info">Belum ada peserta yang mendaftar pelatihan ini.</div>
    @endif
</div>
@endsection
