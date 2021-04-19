<?php

namespace App\Http\Controllers;

use App\Imports\StudentsImport;
use App\Models\Clas;
use App\Models\ClassMember;
use App\Models\DayscholarRoute;
use App\Models\Student;
use App\Models\StudentGuardian;
use App\Models\StudentGuardianRelation;
use App\Models\User;
use App\Traits\SaveGuardian;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\ReferenceNumber;
use App\Traits\ResultProcessor;

class StudentController extends Controller
{
    use SaveGuardian, SoftDeletes, ReferenceNumber, ResultProcessor;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.student.index', ['students' => Student::get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (is_null(Clas::find($request->class))) {
            return back();
        }

        if($request->type){
            return view('app.resource.student.crud.import', ['class' => Clas::find($request->class), 'callback'=>$request->callback]);
        }
        return view('app.resource.student.crud.create', ['classes' => Clas::all(), 'relations' =>StudentGuardianRelation::all(), 'dedicated_class' => $request->class, 'callback'=>$request->callback]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->_import)
        {
            Excel::import(new StudentsImport($request->class_id), request()->file('file'));
        }
        else
        {
                    //save student to users
        $this->storeUser(['first_name'=>$request->sfirst_name,'second_name'=>$request->ssecond_name,'sur_name'=>$request->ssur_name,'gender'=>$request->sgender]);

        //Save to student
        $student_id = Student::create(['user_id' => $this->user_id, 'dob' => date('Y-m-d', strtotime($request->dob))])->id;

        //save student to respective class
        ClassMember::create(['student_id' => $student_id, 'class_id' =>$request->class_id, 'reference_no'=>$this->getReferenceNumber(ClassMember::class, [10000, 99999])]);

        //store parent
        if (User::where('email',$request->email)->first())//check if email already exists, if so use it
        {
           $this->user_id = User::where('email',$request->email)->first()->id;
           $this->storeGuardian($request);
        }
        else
        {
            $this->prepareUSerDataFromRequest($request, ['gender' => StudentGuardianRelation::find($request->relation_id)->gender]);
            $this->saveGuardian($request);
        }

        StudentGuardian::create(['student_id' => $student_id, 'guardian_id' => $this->guardian_id, 'student_guardian_relation_id' => $request->relation_id]);

        //Save to timeline
        Student::find($student_id)->timelines()->create(['description'=>'I joined this school and registered to class '.strtoupper(Clas::find($request->class_id)->grade->name.' '.Clas::find($request->class_id)->stream->name), 'year' => Clas::find($request->class_id)->academic_year_id, 'date'=>date('Y-m-d')]);

        }
        //return to index
        if (!is_null($request->callback)) {
            return redirect($request->callback);
        }
        return redirect(route('students.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Student $student)
    {
        $links = [
            ['name'=>'Home','link' => null],
            ['name'=>'Academic','link' => 'a'],
            ['name'=>'Accounts','link' => 'c'],
            ['name'=>'Timeline','link' => 't']
        ];
        $academic_links = ['Results', 'Progress'];

        return view('app.resource.student.crud.show',['academic_links'=>$academic_links, 'student' =>  $student, 'links' => $links, 'link' => $request->link, 'routes'=>DayscholarRoute::all(), 'results'=>$this->getLAllStudentResults($student), 'academic'=>$request->academic, 'academic_active'=>in_array($request->academic, $academic_links)?$request->academic:'Results']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Student $student)
    {
        return view('app.resource.student.crud.edit', ['student' => $student, 'classes' => Clas::all(), 'relations' =>StudentGuardianRelation::all(), 'callback'=>$request->callback]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //$student->update($request->input());
        $this->updateUser($request->u_s, ['first_name'=>$request->sfirst_name,'second_name'=>$request->ssecond_name,'sur_name'=>$request->ssur_name,'gender'=>$request->sgender]);

        $student->update($request->only('dob'));

        StudentGuardian::find($request->relate)->update(['student_guardian_relation_id' => $request->relation_id]);

        ClassMember::find($request->class)->update($request->only('class_id'));

        //prepare data to save guardian
        $this->prepareUSerDataFromRequest($request, ['gender' => StudentGuardianRelation::find($request->relation_id)->gender]);

        //so save guardian
        $this->startUpdateGuardianGuardian($request);

        //return to index
        if (!is_null($request->callback)) {
            return redirect($request->callback);
        }
        return redirect(route('students.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back();
    }
}
