<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.exam.index', ['exams'=>Exam::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $academic_year = AcademicYear::orderBy('created_at', 'ASC')->first();

        if (is_null($academic_year)) return redirect(route('academic-years.create'));
        return view('app.resource.exam.crud.create', ['callback'=>$request->callback, 'class'=>$request->class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('type', 'name', 'total_marks', 'academic_year', 'date');
        $academic_year = ['academic_year'=>AcademicYear::orderBy('created_at', 'ASC')->first()->id];

        if ($request->type == 'public')
        {
            Exam::updateOrCreate(array_merge($data, $academic_year));
        }
        else
        {
            $owner = ['user_id'=>Auth::user()->id];
            Exam::updateOrCreate(array_merge($owner, $data, $academic_year));
        }

        if($request->callback) return redirect($request->callback);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        return view('app.resource.exam.crud.show',['exam'=>$exam]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Exam $exam)
    {
        return view('app.resource.exam.crud.edit', ['callback'=>$request->callback, 'class'=>$request->class, 'exam'=>$exam]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        $exam->update($request->only(['name', 'type', 'date', 'total_marks']));

        if($request->callback) return redirect($request->callback);
        return redirect(route('exams.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
