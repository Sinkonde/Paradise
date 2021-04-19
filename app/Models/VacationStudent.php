<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class VacationStudent extends Model
{
    protected $fillable = ['to', 'student_id'];
}
