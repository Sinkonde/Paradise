<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = ['user_id','address', 'work', 'location'];

    public function particulars(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function worker(){
        return $this->hasOne(Worker::class, 'guardian_id');
    }

    public function my_kids(){
        return $this->hasMany(StudentGuardian::class, 'guardian_id');
    }
}
