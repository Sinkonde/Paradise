<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class AwardTitle extends Model
{
    protected $fillable = ['name', 'description'];

    public function academic_award_year($academic_award_id=null){
        if (is_null($academic_award_id)) {
            return $this->hasMany(AcademicAwardYear::class, 'award_title_id', 'id');
        }
        return $this->hasMany(AcademicAwardYear::class, 'award_title_id', 'id')->where('academic_award_id', $academic_award_id);
    }
}
