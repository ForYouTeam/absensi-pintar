<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;
    protected $table = "jabatan";
    protected $fillable = [
        'id',
        'nama_jabatan',
        'created_at',
        'updated_at'
    ];
}
