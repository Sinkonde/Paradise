<?php
namespace App\Traits;

use App\Models\Clas;
use App\Models\ClassMember;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\StudentGuardianRelation;
use App\Models\User;

trait StudentsImport{

    public $student_id;
    public $parent_id;
    public $class_id;

    public function student($row){
        return [
            'first_name' =>$row[0],'second_name' =>$row[1], 'sur_name' =>$row[2], 'gender' =>$row[3],
        ];
    }

    public function parent($row){
        return [
            'first_name' =>$row[6],'second_name' =>$row[7], 'sur_name' =>$row[8], 'gender' =>'m',
        ];
    }

    public function guardian($row){
        return [
            'work' =>$row[9],'location' =>$row[10]?$row[10]:'', 'address' =>''
        ];
    }

    public function registerUserStudent($row){
        $this->student_id = User::updateOrCreate($this->student($row))->id;
    }

    public function registerUserParent($row){
        $this->parent_id = User::updateOrCreate($this->parent($row))->id;
        $this->user_id = $this->parent_id;
    }

    public function registerStudent($row){
        $this->student_id = Student::updateOrCreate(['user_id'=>$this->student_id, 'dob'=>$row[4], 'joined'=>date('Y-m-d')])->id;
    }

    public function registerGuardian($row){
        $this->parent_id = Guardian::create(array_merge($this->guardian($row), ['user_id'=>$this->parent_id]))->id;
    }

    public function registerRelation(){
        StudentGuardian::updateOrCreate(['student_id' => $this->student_id, 'guardian_id' => $this->parent_id, 'student_guardian_relation_id'=>StudentGuardianRelation::where('name', 'Baba Mzazi')->first()->id])->id;
    }

    public function addToClass(){
        ClassMember::updateOrCreate(['class_id'=>$this->class_id, 'student_id' =>$this->student_id, 'reference_no'=>$this->getReferenceNumber('classmember', [10000,99999])]);
    }

    public function addToTimeline(){
        Student::find($this->student_id)->timelines()->create(['description'=>'I joined this school and registered to class '.strtoupper(Clas::find($this->class_id)->grade->name.' '.Clas::find($this->class_id)->stream->name), 'year' => Clas::find($this->class_id)->academic_year_id, 'date'=>date('Y-m-d')]);
    }

    public function import($row){
        //dd($row);
        //register student as user
        $this->registerUserStudent($row);

        //register parent as user
        $this->registerUserParent($row);

        //store parent phone
        $this->storePhone((object)['phone'=>str_replace('|',',',$row[11])]);

        //register student
        $this->registerStudent($row);

        //register parent as guardian
        $this->registerGuardian($row);

        //register student_parent relation
        $this->registerRelation();

        //add to class
        $this->addToClass();

        //add to timelines
        $this->addToTimeline();
    }
}
