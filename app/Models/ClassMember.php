<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class ClassMember extends Model
{
    public function class(){
        return $this->belongsTo(Clas::class, 'class_id');
    }

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function marks(){
        return $this->hasMany(Mark::class, 'student_id');
    }

    public function is_dayscholar(){
        return $this->hasMany(Dayscholar::class, 'student_id')->orderBy('created_at', 'desc')->where('to', NULL);
    }
}
