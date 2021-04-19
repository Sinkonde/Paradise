<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Dayscholar extends Model
{
    protected $fillable = ['student_id', 'route_id', 'from', 'to'];
    
    public function route(){
        return $this->belongsTo(DayscholarRoute::class, 'route_id');
    }
}
