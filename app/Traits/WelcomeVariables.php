<?php
namespace App\Traits;

use App\Models\AcademicYear;
use App\Models\Clas;
use App\Models\ClassMember;
use App\Models\ClassResult;
use App\Models\ClassSubject;
use App\Models\User;

trait WelcomeVariables
{
    public function getBoysAndGirlsStudents($academic_year=null){
        $class_members = [];
        if (is_null($academic_year)) {
            $academic_year = AcademicYear::where('year',date('Y'))->first()->id;
        }

        $classes = Clas::where('academic_year_id', $academic_year)->get();

        foreach (['m', 'f'] as $gender) {
            foreach ($classes as $class){
                $class_id = $class->id;
                $members =  User::whereHas('student', function($student) use ($class_id) {
                    $student->whereHas('current_class', function($class) use ($class_id){
                        $class->where('class_id', $class_id);
                    })->where('status', 'active');
                });

                $class_members[$class->id][$gender] = count($members->where('gender', $gender)->get());
            }
        }

        return $class_members;
    }

    function classMembersCountPerClasses(){
        $class_members = [];
        $avail_members = $this->getBoysAndGirlsStudents();

        // $classes = Clas::whereHas('grade', function($grade){
        //         return $grade->orderBy('grade', 'asc');
        //     });

        foreach (Clas::all() as $class) {
            if (isset($avail_members[$class->id])) {
                $class_members[$class->grade->name.'-'.$class->stream->name]=$avail_members[$class->id];
            }
        }

        return $class_members;
    }

    function totalStudents(){
        $boys =[]; $girls = [];
        foreach ($this->getBoysAndGirlsStudents() as $members => $count) {
            array_push($boys, $count['m']);
            array_push($girls, $count['f']);
        }

        return ['boys'=>array_sum($boys), 'girls'=>array_sum($girls)];
    }

    function homeVariables(){
        return [
            'studentsCountInClasses' => $this->classMembersCountPerClasses(),
            'totalStudents'          => $this->totalStudents(),
            'members_count'          => $this->countAllMembers($this->getAllCurrentClassesMembers())
        ];
    }

    function getAllCurrentClassesIds(){
        $classes_ids = [];
        foreach (Clas::where('academic_year_id', AcademicYear::where('year', date('Y'))->first()->id)->get() as $class) {
            array_push($classes_ids, $class->id);
        }

        return $classes_ids;
    }

    function getAllCurrentClassesMembers(){
        return ClassMember::whereIn('class_id', $this->getAllCurrentClassesIds())->get();
    }
}
