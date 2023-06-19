<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
    use HasFactory;
    protected $table = "kelas";
    protected $fillable = [
        'id',
        'nama_kelas',
        'level',
        'jurusan_id',
        'created_at',
        'updated_at'
    ];

    public function scopejoinList($query)
    {
        return $query
        ->leftJoin('jurusan as model_a', 'kelas.jurusan_id', '=', 'model_a.id')
        ->select(
            'kelas.id',
            'kelas.nama_kelas',
            'kelas.level',
            'kelas.jurusan_id',
            'model_a.nama_jurusan as jurusan',
            'kelas.created_at',
            'kelas.updated_at',
        );
    }
}
