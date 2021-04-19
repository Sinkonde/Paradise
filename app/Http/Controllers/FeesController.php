<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Fees;
use App\Models\FeesCategory;
use App\Models\FeesCategoryYear;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class FeesController extends Controller
{
    public $academic_year;

    function __construct()
    {
        $this->academic_year = AcademicYear::orderBy('created_at', 'desc')->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->fees_category & request()->year)
        {
            $fees = FeesCategoryYear::where('fees_category_id', request()->fees_category)->where('academic_year_id', request()->year)->first()->fees;
        }
        else
        {
            $fees = Fees::all();
        }
        $fees_category = FeesCategory::findOrFail(request()->fees_category);
        return view('app.resource.fees.index',['fees'=>$fees, 'fees_category_year_id' => FeesCategoryYear::where('academic_year_id', $this->academic_year->id)->first()->id, 'title' =>$fees_category, 'year' =>'']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fees_category = FeesCategory::findOrFail(request()->fees_category);
        $year = '';//AcademicYear::findOrFail(request()->fees_category);
        return view('app.resource.fees.crud.create', ['fees_category_year_id' => FeesCategoryYear::where('fees_category_id', $fees_category->id)->first()->id, 'title' =>$fees_category, 'year' =>$year]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $out['level_id'] = $request->level_id == 'All' ? NULL : $request->level_id;
        $out['grade_id'] = $request->grade_id == 'All' ? NULL : $request->grade_id;

        $out = $out + $request->only(['name', 'description', 'fees_category_year_id']);
        //dd($out);
        Fees::create($out);

        return redirect($request->callback);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function show(Fees $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function edit(Fees $fee)
    {
        return view('app.resource.fees.crud.edit', ['fees' => $fee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fees $fee)
    {
        $out['level_id'] = $request->level_id == 'All' ? NULL : $request->level_id;
        $out['grade_id'] = $request->grade_id == 'All' ? NULL : $request->grade_id;

        $out = $out + $request->only(['name', 'description', 'level_id', 'grade_id']);

        $fee->update($out);
        return redirect($request->callback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fees $fee)
    {
        $fee->delete();
        return back();
    }
}
