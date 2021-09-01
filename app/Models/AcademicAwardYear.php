<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class AcademicAwardYear extends Model
{
    protected $fillable = ['award_title_id', 'academic_award_id', 'description'];

    public function award_title(){
        return $this->belongsTo(AwardTitle::class, 'award_title_id', 'id');
    }
}
