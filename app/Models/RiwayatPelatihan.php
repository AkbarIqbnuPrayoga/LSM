<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPelatihan extends Model
{
    protected $table = 'riwayat_pelatihan';

    protected $fillable = ['nama', 'gambar', 'kuota', 'tanggal', 'tag'];
}
