<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prefecture;

class City extends Model
{
    use HasFactory;

    protected $table = 'tbl_city_region';

    protected $fillable = [
        'name',
        'prefecture_id'        
    ];

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
}
