<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class LevelSubject extends Model
{
    protected $fillable = ['level_id', 'subject_id'];

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function level(){
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function class_subjects(){
        return $this->hasMany(ClassSubject::class, 'subject_id');
    }
}
