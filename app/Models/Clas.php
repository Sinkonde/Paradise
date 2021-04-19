<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Clas extends Model
{
    protected $fillable =['academic_year_id', 'grade_id', 'stream_id'];

    public function academic_year(){
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function stream(){
        return $this->belongsTo(Stream::class, 'stream_id');
    }

    public function members(){
        return $this->hasMany(ClassMember::class, 'class_id');
    }

    public function subjects(){
        return $this->hasManyThrough(SubjectTeacher::class, ClassSubject::class, 'class_id', 'class_subject_id');
    }

    public function findMembersBy($by='active'){
        return $this->hasMany(ClassMember::class, 'class_id')->where('status', $by);
    }

    public function ordered_members(){
        return $this->hasManyThrough(User::class, Student::class,'user_id', 'id');
    }
}
