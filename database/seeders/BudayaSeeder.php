<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Budaya;

class BudayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Budaya::create([
            'nama' => 'Tari Gandrung',
            'kategori' => 'Tari',
            'deskripsi' => 'Tari tradisional Banyuwangi sebagai bentuk penghormatan pada Dewi Sri.',
            'asal_daerah' => 'Banyuwangi',
        ]);
    }
}
