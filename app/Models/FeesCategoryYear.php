<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class FeesCategoryYear extends Model
{
    public function fees(){
        return $this->hasMany(Fees::class, 'fees_category_year_id');
    }

    public function fees_category(){
        return $this->belongsTo(FeesCategory::class, 'fees_category_id');
    }

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
