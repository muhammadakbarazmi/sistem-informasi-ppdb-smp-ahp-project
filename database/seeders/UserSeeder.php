<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'level' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'alamat' => 'Kabupaten Lumajang',
            'tanggal_lahir' => '2000-02-29',
            'jenis_kelamin' => 'Laki-laki',
            'gambar' => 'fotosiswa/dandi 2.jpg',
            'remember_token' => Str::random(),
        ]);
        
        DB::table('users')->insert([
            'name' => 'M. Akbar Azmi',
            'level' => 'siswa',
            'email' => 'makbarazmi@gmail.com',
            'password' => Hash::make('siswa123'),
            'alamat' => 'Kabupaten Ponorogo',
            'tanggal_lahir' => '2000-05-12',
            'jenis_kelamin' => 'Laki-laki',
            'gambar' => 'fotosiswa/rozak.jpg',
            'remember_token' => Str::random(),
        ]);
    }
}
