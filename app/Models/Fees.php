<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fillable = ['name', 'description', 'level_id', 'grade_id', 'fees_category_year_id'];

    public function fee_structure(){
        return $this->morphMany(FeeStructure::class, 'fee_structure');
    }

    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function fees_category_year(){
        return $this->belongsTo(FeesCategoryYear::class, 'fees_category_year_id');
    }
}
