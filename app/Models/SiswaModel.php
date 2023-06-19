<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $fillable = [
        'id',
        'nisn',
        'nama',
        'tmpt_lahir',
        'tgl_lahir',
        'alamat',
        'hp',
        'sex',
        'agama',
        'kelas_id',
        'jurusan_id',
        'created_at',
        'updated_at'
    ];
}
