<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\VacationStudent;
use Illuminate\Http\Request;

class VacationStudentController extends Controller
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
        $csrf = csrf_token();
        if($request->$csrf === csrf_token()){
            //send all active members to vacation
            foreach (Student::where('status','active')->get() as $student) {
                VacationStudent::create(['student_id'=>$student->id]);
            }
            $msg = 'All students are now';
        }
        else{
            //send only one to vacation
        }
        return back()->with('success', $msg.' home for vacation');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VacationStudent  $vacationStudent
     * @return \Illuminate\Http\Response
     */
    public function show(VacationStudent $vacationStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VacationStudent  $vacationStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(VacationStudent $vacationStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VacationStudent  $vacationStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacationStudent $vacation)
    {
        //dd($vacation);
        $vacation->update(['to'=>date('Y-m-d H:i:s')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VacationStudent  $vacationStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacationStudent $vacationStudent)
    {
        //
    }
}
