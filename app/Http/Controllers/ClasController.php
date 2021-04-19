<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Clas;
use App\Models\ClassResult;
use App\Models\ClassSubject;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Stream;
use App\Traits\ClassControllerVariables;
use Illuminate\Http\Request;
use App\Traits\Validator;
use App\Traits\ResultProcessor;
use PDF;

class ClasController extends Controller
{
    use Validator, ResultProcessor, ClassControllerVariables;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.class.index',['classes' => Clas::orderBy('created_at', 'ASC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $for_level = Level::find($request->for_level) ? Level::find($request->for_level) : null;

        $grades = Grade::where('level_id', $request->for_level)->orderBy('grade','ASC')->get();
        $streams = Stream::where('level_id', $request->for_level)->orderBy('name','ASC')->get();

        return view('app.resource.class.crud.create',['levels' => Level::all(),'streams' => $streams, 'grades' =>$grades, 'academicYears' => AcademicYear::all(), 'for_level' => $for_level, 'callback' => $request->callback]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['academic_year_id' =>'required','grade_id' =>'required', 'stream_id' =>'required']);
        Clas::updateOrCreate($request->only(['academic_year_id','grade_id', 'stream_id']));

        if ($request->callback) {
            return redirect($request->callback);
        }
        return redirect(route('classes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Clas $class)
    {

        $data = $this->classControllerVariables($request, $class);

        if (request()->import_members == 'pdf') {
            return PDF::loadView('exports.pdf.class.members.index', $data)->stream('members.pdf');
        }

        return view('app.resource.class.crud.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function edit(Clas $clas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clas $clas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clas $clas)
    {
        $clas->delete();
        return redirect(route('classes.index'));

    }
}
