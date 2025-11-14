<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@casakawi.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status'=> '1'
        ]);

        User::create([
            'name' => 'Seniman Coba',
            'email' => 'seniman@casakawi.com',
            'password' => Hash::make('password'),
            'role' => 'seniman',
            'status' => '1',
        ]);
    }
}
