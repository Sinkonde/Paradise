<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class UserPhone extends Model
{
    protected $fillable = ['phone', 'user_id'];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
