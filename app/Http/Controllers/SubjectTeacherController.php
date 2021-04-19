<?php

namespace App\Http\Controllers;

use App\Models\SubjectTeacher;
use Illuminate\Http\Request;
use App\Traits\ReferenceNumber;

class SubjectTeacherController extends Controller
{
    use ReferenceNumber;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->teacher_id == '_w')
        {
            SubjectTeacher::where('class_subject_id', $request->subject_id)->update(['to'=>date('Y-m-d')]);
        }
        else
        {
            $sub_avail = SubjectTeacher::where('class_subject_id', $request->subject_id)->orderBy('created_at', 'DESC')->first();
            if (!is_null($sub_avail)) {
                if(is_null($sub_avail->to)){
                    SubjectTeacher::where('class_subject_id', $request->subject_id)->update(['to'=>date('Y-m-d')]);
                }
            }
            $request->validate(['subject_id'=>'required', 'teacher_id'=>'required']);
            SubjectTeacher::create(['class_subject_id'=>$request->subject_id, 'teacher_id' => $request->teacher_id, 'from' => date('Y-m-d'), 'reference_no' => $this->getReferenceNumber(SubjectTeacher::class)]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectTeacher $subjectTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectTeacher $subjectTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectTeacher $subjectTeacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectTeacher  $subjectTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectTeacher $subjectTeacher)
    {
        //
    }
}
