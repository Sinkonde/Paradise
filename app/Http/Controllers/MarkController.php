<?php

namespace App\Http\Controllers;

use App\Imports\StudentsMarks;
use App\Models\Clas;
use App\Models\ClassResult;
use App\Models\Exam;
use App\Models\Guardian;
use App\Models\Mark;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Traits\MarksImport;
use Illuminate\Support\Facades\Auth;
use App\Traits\ClassControllerVariables;

class MarkController extends Controller
{
    use MarksImport, ClassControllerVariables;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $teacher = Auth::user()->guardian->worker->teacher;
        $subjects = $teacher->subjects;

        if ($request->class) {
            $class = Clas::findOrFail($request->class);
            $members = $this->getMembers($class->id, ['name']);
        }
        else{
            $class = null;
            $members = null;
        }

        if ($request->class && $request->exam) {
            $class_result = ClassResult::firstOrCreate(['class_id'=>$request->class, 'exam_id' => $request->exam]);
            $marks = Mark::where('class_result_id', $class_result->id);
        }
        else{
            $marks = null;
            $class_result = null;
        }

        return view('app.resource.mark.crud.import', ['class_result'=>$class_result,'marks'=>$marks,'class'=>$class, 'exam'=>Exam::find($request->exam), 'callback'=>$request->callback, 'subjects'=>$subjects, 'members' => $members, 'teacher' => $teacher]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->_import == "_import")
        {
            $array = Excel::toArray(new StudentsMarks,request()->file('file'));
            $this->importMarks($array, $request->exam);
        }
        else
        {
            //echo 'Processing single entries';
        }
        return redirect(route('classes.show',['class'=>$request->class_id, 'academic'=>'res','link'=>'a']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Mark $mark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }
}
