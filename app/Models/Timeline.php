<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Timeline extends Model
{
    public function timelinable(){
        return $this->morphTo();
    }
}
