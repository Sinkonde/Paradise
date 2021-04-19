<?php

namespace App\Http\Controllers;

use App\Models\Dayscholar;
use Illuminate\Http\Request;

class DayscholarController extends Controller
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
        Dayscholar::create(array_merge($request->only(['student_id', 'route_id']), ['from'=>date('Y-m-d')]));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dayscholar  $dayscholar
     * @return \Illuminate\Http\Response
     */
    public function show(Dayscholar $dayscholar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dayscholar  $dayscholar
     * @return \Illuminate\Http\Response
     */
    public function edit(Dayscholar $dayscholar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dayscholar  $dayscholar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dayscholar $dayscholar)
    {
        $dayscholar->update(['to'=>date('Y-m-d')]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dayscholar  $dayscholar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dayscholar $dayscholar)
    {
        //
    }
}
