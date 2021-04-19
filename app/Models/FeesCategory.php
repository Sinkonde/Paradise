<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class FeesCategory extends Model
{
    protected $fillable = ['name', 'description'];

    public function fees_category_years(){
        return $this->hasMany(FeesCategoryYear::class, 'fees_category_id');
    }

    public function find_fees_category_year($academic_year){
        return $this->hasMany(FeesCategoryYear::class, 'fees_category_id')->where(['academic_year_id'=>$academic_year]);
    }

    public function fees(){
        return $this->hasManyThrough(Fees::class, FeesCategoryYear::class,'fees_category_id', 'fees_category_year_id');
    }
}
