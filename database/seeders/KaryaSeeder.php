<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karya;
use App\Models\Kategori;
use App\Models\User;

class KaryaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $seniman = User::where('role','seniman')->first();
        $kats = Kategori::all();
        if (!$seniman || $kats->isEmpty()) return;

        foreach ($kats as $kat) {
            for ($i=1;$i<=2;$i++){
                Karya::create([
                    'nama_karya'=> "Karya $i ".$kat->nama_kategori,
                    'tahun_dibuat'=> 2020 + $i,
                    'asal_daerah'=> 'Daerah '.$kat->nama_kategori,
                    'kategori_id'=>$kat->id,
                    'seniman_id'=>$seniman->id,
                    'deskripsi'=>'Deskripsi singkat '.$kat->nama_kategori,
                ]);
            }
        }
    }
}
