<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    protected $table    = 'logs';
    protected $fillable = [
        'id', 'section', 'tgl_gate', 'open', 'close', 'nama_guru',
        'rfid_guru', 'nama_siswa', 'rfid_siswa', 'kelas', 'jurusan',
        'status', 'tgl_absen', 'start_tap', 'end_tap', 'created_at', 'updated_at'
    ];

    public function scopewithParams($query, $meta)
    {
        $page = ($meta['page'] - 1) * $meta['limit'];

        return $query->when($meta['kelas'], function ($query, $kelas) {
            return $query->where('kelas', $kelas);
        })
        ->when($meta['status'], function ($query, $status) {
            return $query->where('status', $status);
        })

        ->when($meta['jurusan'], function ($query, $jurusan) {
            return $query->where('jurusan', $jurusan);
        })

        ->when($meta['tgl_absen'], function ($query, $tgl_absen) {
            return $query->where('tgl_absen', $tgl_absen);
        })
        
        ->offset($page)->limit($meta['limit']);
    }
}
