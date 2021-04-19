<?php
namespace App\Traits;

use App\Models\AcademicYear;
use App\Models\ClassMember;
use App\Models\SubjectTeacher;

trait ReferenceNumber{
    public $reference_no;
    public $academic_year = null;

    public function getRandomNumber($min, $max){
        return mt_rand($min, $max);
    }

    public function formatYearIntoTwoDigits(){
        return is_null($this->academic_year) ? date('y'): date('y', strtotime($this->academic_year));
    }

    public function generateReferenceNumber($min, $max){
        return $this->reference_no = $this->formatYearIntoTwoDigits().$this->getRandomNumber($min, $max);
    }

    public function checkIfReferenceNumberExistInDB($model){
        return $model::where('reference_no', $this->reference_no)->first();
    }

    public function getAcademicYear(){
        return $this->academic_year = AcademicYear::orderBy('created_at', 'DESC')->first()->year;
    }

    public function getReferenceNumber($model='subject', $range=[100,999]){
        if ($model == 'subject') {
            $model = Subject::class;
        }
        else{
            $model = ClassMember::class;
        }

        $this->getAcademicYear();
        $this->generateReferenceNumber($range[0], $range[1]);

        if (!is_null($this->checkIfReferenceNumberExistInDB($model))) {
            $this->generateReferenceNumber($range[0], $range[1]);
        }
        else{
            return (int) $this->reference_no;
        }
    }
}
