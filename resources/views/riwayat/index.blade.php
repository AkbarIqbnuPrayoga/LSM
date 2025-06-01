@extends('index')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">
        <i class="bi bi-clock-history me-2"></i>Riwayat Pelatihan
    </h4>

    <!-- Filter -->
    <form method="GET" class="row row-cols-auto g-2 align-items-end mb-4">
        <div class="col">
            <label class="form-label fw-semibold mb-1">
                <i class="bi bi-calendar-event me-1"></i>Tahun
            </label>
            <select name="tahun" class="form-select">
                <option value="">Semua Tahun</option>
                @foreach($listTahun as $th)
                    <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label class="form-label fw-semibold mb-1">
                <i class="bi bi-tags me-1"></i>Tag
            </label>
            <select name="tag" class="form-select">
                <option value="">Semua Tag</option>
                <option value="offline" {{ request('tag') == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="online" {{ request('tag') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="hybrid" {{ request('tag') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
        </div>
        <div class="col d-flex align-items-end">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-funnel me-1"></i> Filter
            </button>
        </div>
    </form>

    <!-- Tabel Riwayat -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th><i class="bi bi-book me-1"></i>Nama Pelatihan</th>
                            <th><i class="bi bi-calendar3 me-1"></i>Tanggal</th>
                            <th><i class="bi bi-tags me-1"></i>Tag</th>
                            <th><i class="bi bi-geo-alt me-1"></i>Lokasi</th>
                            <th><i class="bi bi-lock me-1"></i>Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge bg-secondary text-capitalize">
                                        <i class="bi bi-tag me-1"></i>{{ $item->tag }}
                                    </span>
                                </td>
                                <td>{{ $item->lokasi ?? '-' }}</td>
                                <td><span class="badge bg-secondary">Tutup</span></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-exclamation-circle me-1"></i>Belum ada riwayat pelatihan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
