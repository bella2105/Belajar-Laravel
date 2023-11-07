<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lulusan extends Model
{
    use HasFactory;
    
    protected $table = 'lulusan';
    
    protected $fillable = [
        'nama',
        'nim',
        'prodi',
        'tahun_lulus',
        'pekerjaan_sekarang',
        'pendidikan_lanjutan'
    ];
}