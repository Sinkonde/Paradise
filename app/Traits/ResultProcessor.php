<?php
namespace App\Traits;

use App\Models\Clas;
use App\Models\ClassMember;
use App\Models\ClassResult;
use App\Models\Mark;
use App\Models\Student;

trait ResultProcessor {

    public $total_of_totals = [];
    function getClassMembersMarksFromDB($class, $class_result_id){
        $results = [];
        foreach ($class->members as $member) {
            if (count($member->marks()->where('class_result_id', $class_result_id)->get())==0) {
                continue;
            }
            $results[$member->id] = $this->processMarksPerSubject($member->marks()->where('class_result_id', $class_result_id)->get());
        }

        return $this->positioningResults($this->sortResults($results));
    }

    function processMarksPerSubject($my_marks){
        $marks = [];
        foreach ($my_marks as $mark) {
            $marks['subjects'][$mark->subject_id] = $mark->mark;
        }
        ksort($marks['subjects']);
        $marks['total'] = array_sum($marks['subjects']);

        return $marks;
    }

    function sortResults($results){
        $total = [];
        foreach($results as $key => $value){
            array_push($total,$value['total']);
        }
        array_multisort($total, SORT_DESC, $results);

        return $results;
    }

    function positioningResults($results){
        $position = 0;
        $preValue = 0;
        $finalData = [];
        $rows = 0;

        foreach ($results as $key => $value)
        {
            $rows++;
            if($value['total'] != $preValue)
            {
                $preValue = $value['total'];
                $position = $rows;
                $value['position'] = $position;
            }
            else
            {
                $value['position'] = $position;
            }
            $finalData[$key] = $value;
        }

        return $finalData;
    }

    function createSummary($results){
        $subs = [];
        $out = [];
        foreach ($results as $key => $subject) {
            foreach ($subject['subjects'] as $subject => $mark) {
                if (isset($subs[$subject])) {
                    array_push($subs[$subject], $mark);
                }
                else{
                    $subs[$subject] = [$mark];
                }
            }
        }

        foreach ($subs as $key => $value) {
            $out[$key] = ['total'=>round(array_sum($value) / count($value),1)];
            $this->total_of_totals[] = array_sum($value) / count($value);
        }

        return $this->positioningResults($this->sortResults($out));
    }

    function subSummary($results){
        $summary = [];
        foreach ($results as $student => $array) {
            $gender = ClassMember::find($student)->student->particulars->gender;

            foreach ($array['subjects'] as $key => $value) {
                if (empty($summary[$key][setGrade($value)][$gender]) or is_null($summary[$key][setGrade($value)][$gender])) {
                    $summary[$key][setGrade($value)][$gender] = [$student];
                }
                else
                {
                    $summary[$key][setGrade($value)][$gender] = array_merge($summary[$key][setGrade($value)][$gender], [$student]);
                }
            }
        }

        return $summary;
    }

    function processResults($class, $class_result_id){
        $results = $this->getClassMembersMarksFromDB($class, $class_result_id);

        if (count($this->total_of_totals)==0)
        {
            $out = [];
        }
        else
        {
            $out = [
                'results'       => $results,
                'summary'       => $this->createSummary($this->getClassMembersMarksFromDB($class, $class_result_id)),
                'total_avg'     => round(array_sum($this->total_of_totals) / count($this->total_of_totals),1),
                'sub_summary'   => $this->subSummary($results)
            ];
        }

        return $out;
    }

    //get all class result when you have a student
    function getLAllStudentResults($student){
        $studentResult = array();
        foreach ($student->current_class()->orderBy('created_at', 'desc')->get() as $member) {
            $ClassResult = ClassResult::where('class_id',$member->class_id)->orderBy('created_at', 'desc')->get();

            foreach ($ClassResult as $class_result) {
                    if (!Mark::where('student_id', $member->class_id)->where('class_result_id',$class_result->id)->get()) {
                        break;
                    }
                    $results = $this->processResults(Clas::find($member->class_id), $class_result->id);
                    if (array_key_exists($member->id, $results['results'])) {
                        $studentResult = array_merge($studentResult, [$class_result->exam->id => $results['results'][$member->id]]);
                    }
            }
        }
        return $studentResult;
    }

    function getSpecificExamResluts($student, $exam){
        $results = $this->getLAllStudentResults($student);

        return $results[$exam];
    }
}
