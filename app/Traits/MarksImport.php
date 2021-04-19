<?php
namespace App\Traits;

use App\Models\ClassMember;
use App\Models\ClassResult;
use App\Models\Mark;
use App\Models\Student;
use App\Models\SubjectTeacher;

trait MarksImport{
    public $subjects;
    public $template_data;
    public $class_result_id;

    function findByReferenceNumber($model, $number){
        return $model::where('reference_no', $number)->first();
    }

    function removeSubjectNamesFromArray(){
        $this->subjects = array_shift($this->template_data);
    }

    function buildCreateArray($student, $subject, $mark){
        return [
            'student_id'        => $this->findByReferenceNumber(ClassMember::class, $student)->id,
            'subject_id'        => $this->findByReferenceNumber(SubjectTeacher::class, $subject)->id,
            'class_result_id'   => $this->class_result_id,
            'mark'              => is_int($mark)?$mark:null,
        ];
    }

    function extractStudentNumber($data){
        return $data[0];
    }

    function extractSubjectNumber($number){
        return (int) preg_replace('/\D/','',$number);
    }

    function createResultsForThisClass($exam, $student_ref){
        $this->class_result_id = ClassResult::updateOrCreate(['exam_id'=>$exam, 'class_id'=>$this->findByReferenceNumber(ClassMember::class, $student_ref)->class->id])->id;

    }

    function importMarks($array, $exam){
        if (!is_array($array)) return;

        $i = 0;
        foreach ($array as $key => $value) {
            $this->template_data = $value;
            $this->removeSubjectNamesFromArray();

            if ($i == 0)
            {
                //determine the class of this sheet and create results for this class
                $this->createResultsForThisClass($exam, $this->template_data[0][0]);
            }

            foreach ($this->template_data as $t => $v) {
                for ($i=3; $i < count($this->subjects); $i++) {
                    if (is_null($v[$i]) or is_null($this->subjects[$i])) {
                        continue;
                    }
                    else {
                        $data = $this->buildCreateArray($this->extractStudentNumber($v), $this->extractSubjectNumber($this->subjects[$i]), $v[$i]);

                        //update Mark
                        if (!is_null(Mark::where(array_slice($data,0,3))->first())) {
                            Mark::where(array_slice($data,0,3))->update($data);
                        }
                        else{
                            Mark::create($data);
                            $description = "I did ".title(SubjectTeacher::find($data['subject_id'])->class_subject->level_subject->subject->name)." exam and got ".$data['mark']." mark which is equivalent to grade ".setGrade($data['mark']);
                            addToTimeline(Student::find(ClassMember::find($data['student_id'])->student_id), $description, ['date'=>date('Y-m-d'), 'year'=>ClassMember::find($data['student_id'])->class->academic_year_id]);
                        }
                    }

                }
            }
            $i++;
        }
    }
}
