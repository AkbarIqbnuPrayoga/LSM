@extends('index')

@section('content')
<div class="container mt-4">
    <h4><i class="bi bi-clock-history me-2"></i>Riwayat Pelatihan</h4>

    <!-- Filter Tahun & Tag -->
    <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <select name="tahun" class="form-select">
                <option value="">-- Semua Tahun --</option>
                @foreach($listTahun as $th)
                    <option value="{{ $th }}" {{ request('tahun') == $th ? 'selected' : '' }}>{{ $th }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="tag" class="form-select">
                <option value="">-- Semua Tag --</option>
                <option value="offline" {{ request('tag') == 'offline' ? 'selected' : '' }}>Offline</option>
                <option value="online" {{ request('tag') == 'online' ? 'selected' : '' }}>Online</option>
                <option value="online" {{ request('tag') == 'online' ? 'selected' : '' }}>Online</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </form>

    <!-- Tabel Riwayat -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>Nama Pelatihan</th>
                    <th>Tanggal</th>
                    <th>Tag</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($item->tag) }}</td>
                        <td>{{ $item->lokasi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada riwayat pelatihan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
