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
        'gate_id',
        'siswa_id',
        'status',
        'tgl',
        'start_tap',
        'end_tap',
        'created_at',
        'updated_at'
    ];
    
    public function scopegetByFilter($query, $params)
    {
        return $query
            ->where('gate_id' , $params['gate_id' ])
            ->where('siswa_id', $params['siswa_id'])
            ->where('tgl'     , $params['tgl'     ]);
    }

    public function scopejoinList($query)
    {
        return $query 
        ->leftJoin('siswa as model_a', 'daftar_hadir.siswa_id', '=', 'model_a.id')
        ->select(
            'daftar_hadir.gate_id',
            'daftar_hadir.siswa_id',
            'model_a.nama as siswa',
            'daftar_hadir.status',
            'daftar_hadir.tgl',
            'daftar_hadir.start_tap',
            'daftar_hadir.end_tap'
        );
    }

    public function siswa()
    {
        return $this->belongsTo(SiswaModel::class, 'siswa_id');
    }

    public function gate()
    {
        return $this->belongsTo(GateModel::class, 'gate_id');
    }
}
