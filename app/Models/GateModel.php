<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GateModel extends Model
{
    use HasFactory;
    protected $table = 'gate';

    protected $fillable = [
        'id',
        'section',
        'kelas_id',
        'guru_id',
        'mapel',
        'tgl',
        'status',
        'open',
        'close',
        'created_at',
        'updated_at'
    ];

    public function scopegetSection($query, $rfid)
    {
       return $query
        ->whereRaw("SUBSTRING_INDEX(section, '_', -1) = ?", [$rfid])
        ->where('tgl', Carbon::now()->format('Y-m-d'))
        ->where('status', 0);
    }

    public function scopejoinList($query)
    {
        return $query
            ->leftJoin('guru as model_b' , 'gate.guru_id' , '=', 'model_b.id' )
            ->select(
                'gate.section',
                'model_b.nama as guru',
                'gate.mapel',
                'gate.open',
            )
            ->orderBy('gate.created_at', 'desc')
            ->take(3)
            ->get();
    }
}
