<?php

namespace App\Http\Controllers;

use App\Models\DayscholarRouteYear;
use Illuminate\Http\Request;

class DayscholarRouteYearController extends Controller
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
        DayscholarRouteYear::create($request->only(['dayscholar_route_id', 'academic_year_id']));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DayscholarRouteYear  $dayscholarRouteYear
     * @return \Illuminate\Http\Response
     */
    public function show(DayscholarRouteYear $dayscholarRouteYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DayscholarRouteYear  $dayscholarRouteYear
     * @return \Illuminate\Http\Response
     */
    public function edit(DayscholarRouteYear $dayscholarRouteYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DayscholarRouteYear  $dayscholarRouteYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayscholarRouteYear $dayscholarRouteYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayscholarRouteYear  $dayscholarRouteYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayscholarRouteYear $dayscholarRouteYear)
    {
        //
    }
}
