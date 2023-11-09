<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';
    
    protected $fillable = [
        'judul_aktivitas',
        'tanggal',
        'penulis',
        'gambar',
        'isi_aktivitas'
    ];
}
