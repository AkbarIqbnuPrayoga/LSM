<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihan';
    protected $fillable = [
    'nama',
    'gambar',
    'tag',
    'tanggal_mulai',
    'tanggal_selesai',
    'konten',
    'kuota',
    'rekening',
    'atas_nama',
    'bank',
    'lokasi',
    'zoom_link',
    'status',
    'harga',
    'waktu_mulai',
    'waktu_selesai',
];
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'pelatihan_id');
    }
}
