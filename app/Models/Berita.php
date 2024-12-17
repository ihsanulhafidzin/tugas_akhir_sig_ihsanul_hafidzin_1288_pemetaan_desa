<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan (default sudah berita)
    protected $table = 'berita';

    // Tentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'berita',
        'gambar'
    ];

    // Jika Anda ingin menggunakan timestamps, Anda bisa membiarkan ini,
    // jika tidak ingin menggunakan, Anda bisa set to false
    public $timestamps = true;
}
