<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $casts = ['at_holiday'=>'boolean'];

    public function particulars(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parents(){
        return $this->hasMany(StudentGuardian::class, 'student_id');
    }

    public function class_member_in(){
        return $this->hasMany(ClassMember::class, 'student_id');
    }

    public function parent(){
        return $this->parents()->first()->guardian->particulars;
    }

    public function details(){
        return $this->particulars();
    }

    public function current_class(){
        return $this->hasMany(ClassMember::class, 'student_id')->orderBy('created_at', 'desc');
    }

    public function getParticularAttribute($value){
        return $this->particular->$value;
    }

    public function at_vacation(){
        return $this->hasMany(VacationStudent::class, 'student_id')->orderBy('created_at', 'desc')->where('to', null);
    }

    public function timelines(){
        return $this->morphMany(Timeline::class, 'timelinable');
    }
}
