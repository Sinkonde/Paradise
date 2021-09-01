<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class ReligionRenomination extends Model
{
    protected $fillable = ['name', 'description', 'religion_id'];

    public function religion(){
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
