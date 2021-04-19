<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Stream extends Model
{
    protected $fillable = ['name', 'level_id', 'description'];

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }
}
