<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Exam extends Model
{
    public function class_results(){
        return $this->hasMany(ClassResult::class, 'exam_id');
    }
}
