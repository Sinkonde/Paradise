<?php

namespace App\Http\Controllers;

use App\Models\LeaderTitle;
use Illuminate\Http\Request;

class LeaderTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.leaders_titles.index',['titles' => LeaderTitle::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('app.resource.leaders_titles.crud.create', ['callback' => $request->callback]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LeaderTitle::create($request->only(['sw_name', 'en_name', 'description']));

        if($request->callback){
            return redirect($request->callback);
        }

        return redirect(route('titles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeaderTitle  $leaderTitle
     * @return \Illuminate\Http\Response
     */
    public function show(LeaderTitle $leaderTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeaderTitle  $leaderTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LeaderTitle $title)
    {
        return view('app.resource.leaders_titles.crud.edit', ['callback' => $request->callback, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeaderTitle  $leaderTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeaderTitle $title)
    {
        $title->update($request->only(['sw_name', 'en_name', 'description']));

        if($request->callback){
            return redirect($request->callback);
        }

        return redirect(route('titles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeaderTitle  $leaderTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeaderTitle $leaderTitle)
    {
        //No any deleting delegence
        return back();
    }
}
