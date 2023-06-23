<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruModel extends Model
{
    use HasFactory;

    protected $table = "guru";
    protected $fillable = [
        'id',
        'nip',
        'nama',
        'sex',
        'agama',
        'status',
        'jabatan_id',
        'golongan',
        'mapel_id',
        'created_at',
        'updated_at'
    ];

    public function scopejoinList($query)
    {
        return $query
        ->leftJoin('jabatan as model_a', 'guru.jabatan_id', '=', 'model_a.id')
        ->leftJoin('mapel as model_b', 'guru.mapel_id', '=', 'model_b.id')
        ->select(
            'guru.id',
            'guru.nip',
            'guru.nama',
            'guru.sex',
            'guru.agama',
            'guru.status',
            'guru.jabatan_id',
            'guru.golongan',
            'model_a.nama_jabatan as jabatan',
            'guru.mapel_id',
            'model_b.nama_mapel as mapel',
            'guru.created_at',
            'guru.updated_at',
        );
    }
}
