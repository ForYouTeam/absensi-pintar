<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaModel extends Model
{
    use HasFactory;
    protected $table = "siswa";
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
        'rfid',
        'foto',
        'created_at',
        'updated_at'
    ];

    public function scopejoinList($query)
    {
        return $query
        ->leftJoin('kelas as model_a', 'siswa.kelas_id', '=', 'model_a.id')
        ->leftJoin('jurusan as model_b', 'siswa.jurusan_id', '=', 'model_b.id')
        ->select(
            'siswa.id',
            'siswa.nisn',
            'siswa.nama',
            'siswa.tmpt_lahir',
            'siswa.tgl_lahir',
            'siswa.alamat',
            'siswa.hp',
            'siswa.sex',
            'siswa.agama',
            'siswa.kelas_id',
            'model_a.nama_kelas as kelas',
            'siswa.jurusan_id',
            'model_b.nama_jurusan as jurusan',
            'siswa.rfid',
            'siswa.foto',
            'siswa.created_at',
            'siswa.updated_at',
        );
    }
}
