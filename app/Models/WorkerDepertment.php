<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class WorkerDepertment extends Model
{
    public function depertment(){
        return $this->belongsTo(Depertment::class, 'depertment_id');
    }
}
