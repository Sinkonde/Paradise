<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class UserActivePhone extends Model
{
    public function number(){
        return $this->belongsTo(UserPhone::class, 'user_phone_id');
    }
}
