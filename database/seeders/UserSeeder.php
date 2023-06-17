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
            'name' => 'Administrator1',
            'level' => 'admin',
            'email' => 'atiknh1@gmail.com',
            'password' => Hash::make('admin123'),
            'alamat' => 'Kabupaten Ponorogo',
            'tanggal_lahir' => '1997-01-01',
            'jenis_kelamin' => 'Perempuan',
            'gambar' => 'fotosiswa/admin.jpg',
            'remember_token' => Str::random(),
        ]);
    }
}
