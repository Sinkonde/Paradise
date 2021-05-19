<?php

namespace App\Http\Controllers;

use App\Mail\ExamResult;
use App\Models\ClassMember;
use App\Models\Exam;
use App\Models\Student;
use App\Traits\EmailTrait;
use App\Traits\ResultProcessor;
use Illuminate\Http\Request;


class SendEmailToUsersController extends Controller
{
    use ResultProcessor, EmailTrait;

    function sendExamResultsToOneSubscriber(Request $request){
        $data = ['student'=>Student::find($request->student), 'results'=>$this->getSpecificExamResluts(Student::find($request->student), $request->exam), 'exam'=>Exam::find($request->exam)];
        return view('mail.send_results', $data);
        $this->sendEmail($this->sendToStudentGuardian($request->student), $data);
        return back();
    }

    function sendExamResultsToAllSubscribers(Request $request){
        $members = ClassMember::where('class_id', $request->class)->get();

        foreach ($members as $member) {
            $data = ['student'=>Student::find($member->student->id), 'results'=>$this->getSpecificExamResluts(Student::find($member->student->id), $request->exam), 'exam'=>Exam::findOrFail($request->exam)];
            $this->sendEmail($this->sendToStudentGuardian($member->student->id), $data);
        }

        return back();
    }
    
}
