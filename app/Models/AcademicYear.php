<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable =['year', 'coments'];

    public function classes(){
        return $this->hasMany(Clas::class, 'academic_year_id');
    }
}
