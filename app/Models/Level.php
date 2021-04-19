<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Level extends Model
{
    public function grades(){
        return $this->hasMany(Grade::class, 'level_id');
    }

    public function streams(){
        return $this->hasMany(Stream::class, 'level_id');
    }

    public function subjects(){
        return $this->hasMany(Subject::class, 'level_id');
    }
}
