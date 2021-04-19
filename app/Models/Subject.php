<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'short', 'sw_name', 'description'];

    public function levels(){
        return $this->hasMany(LevelSubject::class, 'level_id');
    }
}
