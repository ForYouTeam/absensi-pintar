<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelModel extends Model
{
    use HasFactory;
    protected $table = "mapel";
    protected $fillable = [
        'id',
        'nama_mapel',
        'created_at',
        'updated_at'
    ];   
}
