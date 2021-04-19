<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class ClassResult extends Model
{
    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }

    public function class(){
        return $this->belongsTo(Clas::class, 'class_id');
    }
}
