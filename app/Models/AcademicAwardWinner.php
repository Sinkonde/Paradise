<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class AcademicAwardWinner extends Model
{
    protected $fillable = ['academic_award_id', 'user_id', 'rank'];

    public function academic_awards_year(){
        return $this->belongsTo(AcademicAwardYear::class, 'academic_award_id', 'id');
    }
}
