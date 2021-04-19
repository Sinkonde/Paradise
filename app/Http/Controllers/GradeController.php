<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Traits\Validator;

class GradeController extends Controller
{
    use Validator;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $level_name = Grade::where('level_id', $request->for_level)->first() ? Grade::where('level_id', $request->for_level)->first()->level->name :null;

        $grades = $level_name ? Grade::where('level_id', $request->for_level)->orderBy('grade','ASC')->get() : Grade::orderBy('created_at','ASC')->get();
        //$grades = Grade::orderBy('created_at','ASC')->get();
        return view('app.resource.grade.index', ['grades' => $grades, 'level_name' =>$level_name, 'levels' => Level::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $for_level = Level::find($request->for_level) ? Level::find($request->for_level) : null;

        $grade = Grade::where('level_id', $request->for_level)->orderBy('grade','DESC')->first();
        $grade = is_null($grade) ? 1 : $grade->grade + 1;
        return view('app.resource.grade.crud.create', ['levels' => Level::all(), 'grade' => $grade, 'for_level' => $for_level]);
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
        // if ($this->validation($request,['required' => ['name', 'level_id']]))
        // {
            $grades = explode(',', $request->name);

            foreach ($grades as $grade) {
                Grade::create(['name' => $grade, 'level_id' => $request->level_id, 'grade' => $request->grade]);
                $request->grade++;
            }

            if($request->callback){
                return redirect($request->callback);
            }
        //}
        return redirect(route('grades.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('app.resource.grade.crud.edit',['levels' => Level::all(), 'grade' => $grade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate(['name' => 'required', 'level_id' =>'required']);
        $grade->update($request->input());
        return redirect(route('grades.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return back();
    }
}
