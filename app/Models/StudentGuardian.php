<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    protected $fillable = ['student_id', 'guardian_id', 'student_guardian_relation_id'];

    public function guardian(){
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }

    public function students(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function relation(){
        return $this->belongsTo(StudentGuardianRelation::class, 'student_guardian_relation_id');
    }
}
