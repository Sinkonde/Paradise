<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Worker extends Model
{
    public function guardian(){
        return $this->belongsTo(Guardian::class, 'guardian_id');
    }

    public function worker_depertments(){
        return $this->hasMany(WorkerDepertment::class, 'worker_id');
    }

    public function teacher(){
        return $this->hasOne(Teacher::class, 'worker_id');
    }
}
