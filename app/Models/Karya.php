<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karya extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_karya',
        'tahun_dibuat',
        'asal_daerah',
        'kategori_id',
        'seniman_id',
        'deskripsi',
        'gambar',
        'latitude',
        'longitude',
        'audio'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function seniman()
    {
        return $this->belongsTo(User::class, 'seniman_id');
    }
}
