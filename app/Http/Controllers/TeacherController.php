<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Worker;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.teacher.index', ['teachers' => Teacher::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $teachers = array();
        $all_teachers = Teacher::all();
        if ($all_teachers) {
            foreach ($all_teachers as $teacher) {
                array_push($teachers, $teacher->worker_id);
            }
        }
        return view('app.resource.teacher.crud.create', ['avail_teachers'=> $teachers,'workers' => Worker::all(), 'callback' => $request->callback]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(empty($request->workers)){
            return back();
        }
        foreach ($request->workers as $w => $worker) {
            Teacher::updateOrCreate(['worker_id' => $worker]);
        }

        if ($request->callback) {
            return redirect($request->callback);
        }
        return redirect(route('teachers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return back();
    }
}
