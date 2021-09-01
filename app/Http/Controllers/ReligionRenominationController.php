<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\ReligionRenomination;
use Illuminate\Http\Request;

class ReligionRenominationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.renomination.index',['renominations'=>ReligionRenomination::orderBy('name','ASC')->get(), 'show_religion' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.renomination.crud.create', ['religions'=>Religion::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name'=>'required']);
        ReligionRenomination::create($request->only(['name','religion_id', 'description']));

        return redirect(route('religions.show',$request->religion_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReligionRenomination  $religionRenomination
     * @return \Illuminate\Http\Response
     */
    public function show(ReligionRenomination $religionRenomination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReligionRenomination  $religionRenomination
     * @return \Illuminate\Http\Response
     */
    public function edit(ReligionRenomination $religionRenomination)
    {
        return view('app.resource.renomination.crud.edit', ['renomination'=>$religionRenomination]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReligionRenomination  $religionRenomination
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReligionRenomination $religionRenomination)
    {
        $request->validate(['name'=>'required']);
        $religionRenomination->update($request->only(['name', 'description']));

        if ($request->_callback) {
            return redirect(route($request->_callback));
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReligionRenomination  $religionRenomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReligionRenomination $religionRenomination)
    {
        //
    }
}
