<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DayscholarRoute extends Model
{
    protected $fillable = ['name', 'description'];

    public function route_year($year = null){
        if (!is_null($year)) {
            return $this->hasMany(DayscholarRouteYear::class, 'dayscholar_route_id')->where('academic_year_id', $year);
        }
        return $this->hasMany(DayscholarRouteYear::class, 'dayscholar_route_id');
    }
}
