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
}
