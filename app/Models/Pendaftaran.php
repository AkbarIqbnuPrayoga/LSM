<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran'; // Pastikan sesuai dengan nama tabel di database

    // Jika ada kolom yang bisa diisi
    protected $fillable = [
        'user_id',
        'pelatihan_id',
        // tambahkan kolom lain jika perlu
    ];

    // relasi ke pelatihan
    public function pelatihan()
    {
        return $this->belongsTo(Pelatihan::class, 'pelatihan_id');
    }
    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
