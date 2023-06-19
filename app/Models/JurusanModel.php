<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanModel extends Model
{
    use HasFactory;
    protected $table = "jurusan";
    protected $fillable = [
        'id',
        'nama_jurusan',
        'created_at',
        'updated_at'
    ];
}
