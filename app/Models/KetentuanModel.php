<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetentuanModel extends Model
{
    use HasFactory;
    protected $table = "ketentuan";
    protected $fillable = [
        'id',
        'start',
        'end',
        'tipe',
        'created_at',
        'updated_at'
    ];   
}
