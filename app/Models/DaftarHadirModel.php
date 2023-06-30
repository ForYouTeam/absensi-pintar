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
        ->leftJoin('gate as model_b', 'daftar_hadir.gate_id', '=', 'model_b.id')
        ->select(
            'daftar_hadir.gate_id'         ,
            'model_b.guru_id as guru_id'   ,
            'model_a.kelas_id as kelas_id' ,
            'daftar_hadir.siswa_id'        ,
            'model_a.nama as siswa'        ,
            'daftar_hadir.status'          ,
            'daftar_hadir.tgl'             ,
            'daftar_hadir.start_tap'       ,
            'daftar_hadir.end_tap'
        );
    }

    public function scopegetByKelasGuru($query, $payload)
    {
        return $query
        ->leftJoin('siswa as model_a', 'daftar_hadir.siswa_id', '=', 'model_a.id')
        ->leftJoin('gate as model_b' , 'daftar_hadir.gate_id' , '=', 'model_b.id')
        ->select('*')
        ->where('model_b.kelas_id', $payload['kelas_id'])
        ->where('model_b.guru_id' , $payload['guru_id' ])
        ->whereBetween('daftar_hadir.tgl', [$payload['start'], $payload['end']]);
    }

    public function scopegetWithParams($query, $payload)
    {
        return $query
            ->leftJoin('siswa as model_a'  , 'daftar_hadir.siswa_id', '=', 'model_a.id')
            ->leftJoin('gate as model_b'   , 'daftar_hadir.gate_id' , '=', 'model_b.id')
            ->leftJoin('kelas as model_c'  , 'model_b.kelas_id'     , '=', 'model_c.id')
            ->leftJoin('jurusan as model_d', 'model_a.jurusan_id'   , '=', 'model_d.id')

            ->select(
                'daftar_hadir.id'      ,
                'daftar_hadir.status'  ,
                'daftar_hadir.siswa_id',
                'daftar_hadir.tgl'     ,
                'daftar_hadir.start_tap'     ,
                'model_a.nama'         ,
                'model_c.nama_kelas'   ,
                'model_d.nama_jurusan' ,
                'model_b.kelas_id'     ,
                'model_b.mapel'       
                )

            ->when(isset($payload['kelas_id']) && $payload['kelas_id'] != 0, function ($query) use ($payload) {
                return $query->where('model_b.kelas_id', $payload['kelas_id']);
            })
            ->when(isset($payload['guru_id']) && $payload['guru_id'] != 0, function ($query) use ($payload) {
                return $query->where('model_b.guru_id', $payload['guru_id']);
            });
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
