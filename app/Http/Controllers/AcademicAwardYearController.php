<?php

namespace App\Http\Controllers;

use App\Models\AcademicAward;
use App\Models\AcademicAwardYear;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicAwardYearController extends Controller
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
        //return view('app.resources.academic_award_years.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate(['award_title_id' => 'required']);

        if (is_null($request->academic_award_id))
        {
            $academic_award_id = AcademicAward::firstOrCreate(['name'=>'Academic Awards for '.date('Y'), 'academic_year_id'=>AcademicYear::where('year', date('Y'))->first()->id])->id;
        }
        else{
            $academic_award_id = $request->academic_award_id;
        }
        //dd($request->only(['award_title_id'])+['academic_award_id' => $academic_award_id, 'dscription'=>"Award"]);
        AcademicAwardYear::updateOrCreate($request->only(['award_title_id'])+['academic_award_id' => $academic_award_id]);
        return back()->with(['success' => 'The Award was created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicAwardYear  $academicAwardYear
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicAwardYear $academicAwardYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicAwardYear  $academicAwardYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicAwardYear $academicAwardYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicAwardYear  $academicAwardYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicAwardYear $academicAwardYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicAwardYear  $academicAwardYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicAwardYear $academicAwardYear)
    {
        $academicAwardYear->delete();
        return back()->with(['success' => 'The award was deleted!!']);
    }
}
