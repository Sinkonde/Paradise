<?php

namespace App\Http\Controllers;

use App\Models\ClassSubject;
use App\Models\LevelSubject;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
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
        is_null(LevelSubject::where('level_id',$request->level)->get()) ? back():"";
        $avail = [];
        foreach (ClassSubject::where('class_id', $request->class)->get() as $sub) {
            array_push($avail, $sub->subject_id);
        }
        return view('app.resource.class_subject.crud.create', ['subjects' => LevelSubject::where('level_id',$request->level)->get(), 'callback'=>$request->callback, 'avail' => $avail, 'level_id'=>$request->level, 'class' =>$request->class]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->subjects as $key => $subject) {
            ClassSubject::updateOrCreate(['class_id'=>$request->class, 'subject_id'=>$subject]);
        }
        if ($request->callback) {
            return redirect($request->callback);
        }
        return redirect(route('classes.show',['class'=>$request->class, 'link' => 'a', 'academic'=>'sub']));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassSubject  $classSubject
     * @return \Illuminate\Http\Response
     */
    public function show(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassSubject  $classSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassSubject $classSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassSubject  $classSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassSubject $classSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassSubject  $classSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassSubject $classSubject)
    {
        //
    }
}
