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
}
