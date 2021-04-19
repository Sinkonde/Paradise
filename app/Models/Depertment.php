<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Depertment extends Model
{
    public function members(){
        return $this->hasMany(WorkerDepertment::class, 'depertment_id');
    }
}
