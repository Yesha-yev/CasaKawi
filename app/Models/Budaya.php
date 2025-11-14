<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budaya extends Model
{
    //
    use HasFactory;
    protected $fillable = ['nama','deskripsi', 'asal_daerah', 'kategori', 'gambar'];
}
