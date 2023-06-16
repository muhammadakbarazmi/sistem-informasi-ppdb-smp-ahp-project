<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'no_peserta',
        'nama',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'gambar'
    ];
}
