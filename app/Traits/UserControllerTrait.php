<?php
namespace App\Traits;

use App\Mail\ExamResult;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

trait UserControllerTrait{

    function grantUser($user){
        $user->update(['password' => Hash::make('password')]);
        return true;
        //notify through email
    }

    function blockUser($user){
        $user->update(['password' => null]);
        return true;
    }
}
