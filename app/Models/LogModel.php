<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    protected $table    = 'logs';
    protected $fillable = [
        'id', 'message', 'data', 'code', 'created_at', 'updated_at'
    ];
}
