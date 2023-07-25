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
    
    public function scopegetValidationTime($query, $params)
    {
        $timeNow = $params['timenow'];
        $exists  = $query
        ->where('tipe', 0)
        ->whereTime('start', '<=', $timeNow)
        ->whereTime('end', '>=', $timeNow)
        ->exists();

        if ($exists) {
            return true;
        } else {
            return false;
        }
    }
}
