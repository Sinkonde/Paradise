<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Religion extends Model
{
    protected $fillable = ['name', 'description'];
}
