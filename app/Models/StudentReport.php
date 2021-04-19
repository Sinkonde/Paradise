<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class StudentReport extends Model
{
    protected $fillable = ['name', 'exam_id', 'academic_year', 'closing_date', 'day_open', 'board_open'];

    public function main_exam(){
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
