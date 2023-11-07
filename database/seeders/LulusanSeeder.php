<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LulusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('lulusan')->insert([
        'nama' => 'Rahmadina',
        'nim' => '6304211335',
        'prodi' => 'RPL',
        'tahun_lulus' => '2025',
        'pekerjaan_sekarang' => 'web developers pt Angkasa',
        'pendidikan_lanjutan' => '-'
        ]);
    }
}