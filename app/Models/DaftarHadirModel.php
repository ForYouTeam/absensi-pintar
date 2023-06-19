<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarHadirModel extends Model
{
    use HasFactory;
    
    protected $table = "daftar_hadir";
    protected $fillable = [
        'id',
        'siswa_id',
        'guru_id',
        'mapel_id',
        'tgl',
        'jam_masuk',
        'jam_keluar',
        'created_at',
        'updated_at'
    ];
}
