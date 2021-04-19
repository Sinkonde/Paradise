<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name', 'level_id', 'grade', 'description'];

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function classes(){
        return $this->hasMany(Clas::class, 'grade_id');
    }
}
