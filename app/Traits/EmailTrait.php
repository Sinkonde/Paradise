<?php
namespace App\Traits;

use App\Mail\ExamResult;
use App\Models\Student;
use Illuminate\Support\Facades\Mail;

trait EmailTrait{

    function sendEmail($email, $data){
        Mail::to($email)->send(new ExamResult($data));
    }

    function sendToStudentGuardian($student){
        $user = Student::find($student)->parents->first()->guardian->particulars;
        return $user;
    }
}
