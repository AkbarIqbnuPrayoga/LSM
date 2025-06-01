<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPelatihansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        <h4>Riwayat Pelatihan</h4>
<table class="table">
    <thead>
        <tr>
            <th>Nama Pelatihan</th>
            <th>Tanggal</th>
            <th>Tag</th>
            <th>Lokasi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($riwayats as $riwayat)
            <tr>
                <td>{{ $riwayat->nama }}</td>
                <td>{{ \Carbon\Carbon::parse($riwayat->tanggal)->format('d-m-Y') }}</td>
                <td>{{ ucfirst($riwayat->tag) }}</td>
                <td>{{ $riwayat->lokasi }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pelatihans');
    }
}
