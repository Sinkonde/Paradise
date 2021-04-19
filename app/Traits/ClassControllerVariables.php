<?php
namespace App\Traits;

use App\Models\Clas;
use App\Models\ClassResult;
use App\Models\ClassSubject;
use App\Models\User;

// This trait is simple validate the request input

trait ClassControllerVariables {
    //Main links for classes pages to switch between pages
    public $links = [
                        ['name'=>'Home','link' => null],
                        ['name'=>'members','link' => 'm'],
                        ['name'=>'academic','link' => 'a'],
                        ['name'=>'bursar','link' => 'b'],
                        ['name'=>'Timeline','link' => 't'],

                    ];

    public $_links = ['m', 'a', 't', 'b'];

    //Links responsible to switch between pages of academic
    public $academic_links = [
                                ['name'=>'Subjects','page' => 'sub'],
                                ['name'=>'Results','page' => 'res']
                            ];

    //Links to swith pages when on academic
    public $_academic_links = ['sub', 'res'];

    function classControllerVariables($request, $class){
        $members = $class->members()->get();
        // $members->sortBy(function($member){
        //     return $member->student->particulars->first_name;
        // });
        //dd($request->all());

        return [
            'class'            => $class,
            'links'            => $this->links,
            'link'             => in_array($request->link, $this->_links)?$request->link:null,
            'academic_links'   => $this->academic_links,
            'academic_link'    => in_array($request->academic, $this->_academic_links)?$request->academic:'sub',
            'subjects'         => ClassSubject::where('class_id', $class->id)->get(),
            'results'          => $request->exam?$this->processResults($class, $request->exam):[],
            'exam'             => ClassResult::find($request->exam)??null,
            'members'          => $this->getMembers($class->id),
            'members_count'    => $this->countAllMembers($members),
            'classes'          => $this->getAllClasses($class->academic_year_id)
        ];
    }

    public function getMembers($class_id, $orderBy=['name', 'gender']){

        $members =  User::whereHas('student', function($student) use ($class_id) {
            $student->whereHas('current_class', function($class) use ($class_id){
                if (is_array($class_id)) {
                    $class = $class->where('class_id', $class_id[0]);
                    array_shift($class_id);
                    foreach ($class_id as $id) {
                        $class = $class->orWhere('class_id', $id);
                    }
                }
                else
                {
                    $class->where('class_id', $class_id);
                }
            });
        });

        if(in_array('gender', $orderBy)){
            $members = $members->orderBy('gender', 'asc');
        }

        if(in_array('name', $orderBy)){
            $members = $members->orderBy('first_name', 'asc')->orderBy('second_name', 'asc');
        }

        return $members->get();
    }

    function getAllClasses($academic_year){
        return Clas::where('academic_year_id', $academic_year)->get();
    }


    function countAllMembers($members){
        $registered     = ['B'=>[], 'G'=>[]];
        $reported       = ['B'=>[], 'G'=>[]];
        $at_vacation    = ['B'=>[], 'G'=>[]];
        $dayscholar     = ['B'=>[], 'G'=>[]];
        $boarders       = ['B'=>[], 'G'=>[]];

        foreach ($members as $member) {
            //Registered
            if($member->student->particulars){
                if($member->student->particulars->gender == 'm'){
                    array_push($registered['B'], 1);
                }
                else{
                    array_push($registered['G'], 1);
                }

                //At vacation
                //dd($member->student->at_vacation);
                if ($member->student->at_vacation()->first()) {
                    if (is_null($member->student->at_vacation()->first()->to)) {
                        if($member->student->particulars->gender == 'm'){
                            array_push($at_vacation['B'], 1);
                        }
                        else{
                            array_push($at_vacation['G'], 1);
                        }
                    }
                    else{
                        if($member->student->particulars->gender == 'm'){
                            array_push($reported['B'], 1);
                        }
                        else{
                            array_push($reported['G'], 1);
                        }
                    }
                }
                else {
                    if($member->student->particulars->gender == 'm'){
                        array_push($reported['B'], 1);
                    }
                    else{
                        array_push($reported['G'], 1);
                    }
                }

                //Dayscholar and Boarding
                if ($member->is_dayscholar()->first()) {
                    if($member->student->particulars->gender == 'm'){
                        array_push($dayscholar['B'], 1);
                    }
                    else{
                        array_push($dayscholar['G'], 1);
                    }
                }
                else {
                    if($member->student->particulars->gender == 'm'){
                        array_push($boarders['B'], 1);
                    }
                    else{
                        array_push($boarders['G'], 1);
                    }
                }
            }

        }

        return [
            'registered' => ['B'=>count($registered['B']), 'G'=>count($registered['G'])],
            'reported' => ['B'=>count($reported['B']), 'G'=>count($reported['G'])],
            'at_vacation' => ['B'=>count($at_vacation['B']), 'G'=>count($at_vacation['G'])],
            'dayscholar' => ['B'=>count($dayscholar['B']), 'G'=>count($dayscholar['G'])],
            'boarders' => ['B'=>count($boarders['B']), 'G'=>count($boarders['G'])],
        ];
    }

    function getOtherClassesIdsFromClass($class){
        $classes = $class->grade->classes;
        $class_ids = [];

        if ($classes->count()) {
            foreach ($classes as $class) {
                array_push($class_ids,$class->id);
            }
        }

        return $class_ids;

    }
}
