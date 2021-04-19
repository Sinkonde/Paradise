<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Mark extends Model
{
    function subject_teacher(){
        return $this->belongsTo(SubjectTeacher::class, 'subject_id');
    }
}
