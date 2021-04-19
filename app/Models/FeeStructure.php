<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = ['amount', 'from', 'to'];
    
    public function fee_structure(){
        return $this->morphTo();
    }
}
