<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Laporan::create([
            'nama' => 'Pengguna Umum',
            'email' => 'user@example.com',
            'pesan' => 'Saya menemukan data budaya baru, tolong ditambahkan.'
        ]);

        Laporan::create([
            'nama' => 'Budi',
            'email' => 'budi@example.com',
            'pesan' => 'Ada kesalahan pada data budaya.'
        ]);
    }
}
