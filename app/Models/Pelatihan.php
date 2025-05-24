<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $table = 'pelatihan';
    protected $fillable = ['nama', 'gambar', 'tag', 'tanggal', 'kuota', 'konten' ];
    public function pendaftar()
    {
        return $this->hasMany(Pendaftaran::class, 'pelatihan_id');
    }
}
