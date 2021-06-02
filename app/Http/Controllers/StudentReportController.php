<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\StudentReport;
use Illuminate\Http\Request;
use PDF;
use App\Traits\ResultProcessor;
use App\Traits\ClassControllerVariables;

class StudentReportController extends Controller
{
    use ResultProcessor, ClassControllerVariables;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.student_report.index', ['reports' => StudentReport::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.student_report.crud.create');
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
        $request->validate(['name'=>'required', 'academic_year'=>'required']);
        StudentReport::create($request->only(['name', 'exam_id', 'academic_year', 'closing_date', 'day_open', 'board_open']));
        if ($request->callback) {
            return redirect($request->callback);
        }
        return redirect(route('student-reports.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentReport  $studentReport
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, StudentReport $studentReport)
    {
        if (request()->report_pdf) {

            ///return view('exports.pdf.academic_report.index', ['data'=>$this->processResults(Clas::find(request()->class), request()->class_result_id), 'report' => $studentReport]);
            return PDF::loadView('exports.pdf.academic_report.index', ['data'=>$this->processResults(Clas::find(request()->class), request()->class_result_id), 'report' => $studentReport])->stream('report.pdf');
        }
        if(request()->mkeka_pdf){
            $data = $this->classControllerVariables($request, Clas::find(request()->class));
            $d = [$data, 'report' => $studentReport];
            return PDF::loadView('exports.pdf.mkeka.index', $data)->stream('report.pdf');
        }
        return view('app.resource.student_report.crud.show', ['report' => $studentReport]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentReport  $studentReport
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentReport $studentReport)
    {
        return view('app.resource.student_report.crud.edit',['report'=>$studentReport]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentReport  $studentReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentReport $studentReport)
    {
        $studentReport->update($request->except(['_token', 'callback','_method']));
        return redirect(route('student-reports.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentReport  $studentReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentReport $studentReport)
    {
        //
    }
}
