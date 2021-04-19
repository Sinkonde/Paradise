<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class ClassSubject extends Model
{
    public function level_subject(){
        return $this->belongsTo(LevelSubject::class, 'subject_id');
    }

    public function teacher_subjects(){
        return $this->hasMany(SubjectTeacher::class, 'class_subject_id');
    }

    public function class(){
        return $this->belongsTo(Clas::class, 'class_id');
    }

}
