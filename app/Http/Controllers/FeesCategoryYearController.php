<?php

namespace App\Http\Controllers;

use App\Models\FeesCategoryYear;
use Illuminate\Http\Request;

class FeesCategoryYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fees_structures = [];
        if(request()->year){
            $fees_structures = FeesCategoryYear::where('academic_year_id',request()->year)->get();
        }
        return view('app.resource.fees_category_years.index', ['fees_structures'=>$fees_structures]);
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
        FeesCategoryYear::create($request->only(['fees_category_id', 'academic_year_id']));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeesCategoryYear  $feesCategoryYear
     * @return \Illuminate\Http\Response
     */
    public function show(FeesCategoryYear $feesCategoryYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesCategoryYear  $feesCategoryYear
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesCategoryYear $feesCategoryYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeesCategoryYear  $feesCategoryYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeesCategoryYear $feesCategoryYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesCategoryYear  $feesCategoryYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesCategoryYear $feesCategoryYear)
    {
        $feesCategoryYear->delete();
        return back();
    }
}
