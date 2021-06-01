<?php

namespace App\Models;

use Carbon\Carbon;
use Faker\Provider\bg_BG\PhoneNumber;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'first_name',
        'second_name',
        'sur_name',
        'gender',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function phones(){
        return $this->hasMany(UserPhone::class, 'user_id');
    }

    public function active_phone(){
        return $this->hasOne(UserActivePhone::class, 'user_id');
    }

    public function student(){
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    public function guardian(){
        return $this->hasOne(Guardian::class, 'user_id');
    }

}
