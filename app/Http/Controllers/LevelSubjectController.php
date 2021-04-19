<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\LevelSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class LevelSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('app.resource.level_subject.index',['subjects' => LevelSubject::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $for_level = Level::find($request->for_level) ? Level::find($request->for_level):null;
        $avail = [];
        if ($for_level) {
            foreach (LevelSubject::where('level_id', $request->for_level)->get() as $level) {
                array_push($avail, $level->subject_id);
            }
        }
        return view('app.resource.level_subject.crud.create',['subjects' => Subject::all(), 'callback' => null, 'levels'=>Level::all(), 'for_level'=>$for_level, 'avail' => $avail]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['level_id' => 'required', 'subjects' => 'required']);

        foreach ($request->subjects as $key => $subject) {
            LevelSubject::updateOrCreate(['level_id'=>$request->level_id, 'subject_id'=>$subject]);
        }

        if($request->callback){
            return redirect($request->callback);
        }
        return redirect(route('level-subjects.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LevelSubject  $levelSubject
     * @return \Illuminate\Http\Response
     */
    public function show(LevelSubject $levelSubject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LevelSubject  $levelSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(LevelSubject $levelSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LevelSubject  $levelSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LevelSubject $levelSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LevelSubject  $levelSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(LevelSubject $levelSubject)
    {
        //
    }
}
