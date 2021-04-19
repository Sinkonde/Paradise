<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Teacher extends Model
{
    public function worker(){
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function subjects($current_subjects = true){
        if ($current_subjects) {
            return $this->hasMany(SubjectTeacher::class, 'teacher_id')->whereTo(null);
        }
        else{
            return $this->hasMany(SubjectTeacher::class, 'teacher_id');
        }
    }
}
