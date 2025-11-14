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
         Budaya::firstOrCreate(['nama'=>'Tari Gandrung'], [
            'deskripsi'=>'Tari tradisional Banyuwangi',
            'asal_daerah'=>'Banyuwangi',
            'kategori'=>'Tari',
            'latitude'=> -8.216, 'longitude'=>114.365
        ]);
        Budaya::firstOrCreate(['nama'=>'Reog Ponorogo'], [
            'deskripsi'=>'Seni pertunjukan Ponorogo', 'asal_daerah'=>'Ponorogo', 'kategori'=>'Tari',
            'latitude'=> -7.849, 'longitude'=>111.470
        ]);
    }
}
