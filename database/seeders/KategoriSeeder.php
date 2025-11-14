<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    $kategori = ['Lukisan', 'Tari', 'Patung', 'Wayang', 'Pusaka', 'Candi','Alat Musik','Tekstil'];

    foreach ($kategori as $item) {
        Kategori::create(['nama_kategori' => $item]);
    }
    }
}
