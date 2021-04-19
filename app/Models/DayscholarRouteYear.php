<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class DayscholarRouteYear extends Model
{
    protected $fillable = ['dayscholar_route_id', 'academic_year_id'];

    public function fee_structure(){
        return $this->morphMany(FeeStructure::class, 'fee_structure');
    }
}
