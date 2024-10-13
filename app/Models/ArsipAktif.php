<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipAktif extends Model
{
    use HasFactory;

    protected $table = 'arsip_aktif'; // Tabel di database

    // Kolom yang bisa diisi
    protected $fillable = [
        'title',
        'description',
        'file_path'
    ];
}
