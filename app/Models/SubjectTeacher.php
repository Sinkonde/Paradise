<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $fillable = ['class_subject_id', 'teacher_id', 'reference_no', 'from', 'to'];

    public function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function class_subject(){
        return $this->belongsTo(ClassSubject::class, 'class_subject_id');
    }
}
