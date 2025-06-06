<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['ip_address', 'visited_at'];
    public $timestamps = true;
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function pelatihan()
{
    return $this->belongsTo(Pelatihan::class);
}