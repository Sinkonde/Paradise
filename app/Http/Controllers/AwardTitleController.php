<?php

namespace App\Http\Controllers;

use App\Models\AcademicAward;
use App\Models\AcademicYear;
use App\Models\AwardTitle;
use App\Models\Clas;
use App\Models\Grade;
use App\Traits\ClassControllerVariables;
use Illuminate\Http\Request;

class AwardTitleController extends Controller
{
    use ClassControllerVariables;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get members of grade 7
        $grade_id   = Grade::where('grade', 7)->first()->id;
        $class      = Clas::where('grade_id', $grade_id)->first();
        $members    = $this->getMembers($this->getOtherClassesIdsFromClass($class));

        $academic_award = AcademicAward::where('academic_year_id', AcademicYear::where('year', date('Y'))->first()->id)->first()?AcademicAward::where('academic_year_id', AcademicYear::where('year', date('Y'))->first()->id)->first()->id:null;
        return view('app.resource.award_titles.index', ['award_titles'=>AwardTitle::orderBy('name', 'ASC')->get(), 'academic_award_id' => $academic_award, 'members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.award_titles.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|string']);
        AwardTitle::create($request->except(['_token']));
        return redirect(route('award-titles.index'));
        //return view('app.resource.award_titles.index', ['award_titles'=>AwardTitle::orderBy('name', 'ASC')->get()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AwardTitle  $awardTitle
     * @return \Illuminate\Http\Response
     */
    public function show(AwardTitle $awardTitle)
    {
        return view('app.resource.award_titles.crud.show', ['award_title' => $awardTitle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AwardTitle  $awardTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(AwardTitle $awardTitle)
    {
        return view('app.resource.award_titles.crud.edit', ['award_title' => $awardTitle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AwardTitle  $awardTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AwardTitle $awardTitle)
    {
        $awardTitle->update($request->except(['_token']));
        return redirect(route('award-titles.index'));
        //return view('app.resource.award_titles.index', ['award_titles'=>AwardTitle::orderBy('name','ASC')->get()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AwardTitle  $awardTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(AwardTitle $awardTitle)
    {
        $awardTitle->delete();
        return view('app.resource.award_titles.index', ['award_titles'=>AwardTitle::orderBy('name','ASC')->get()]);
    }
}
