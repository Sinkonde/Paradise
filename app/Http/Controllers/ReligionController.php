<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\ReligionRenomination;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.religion.index',['religions'=>Religion::orderBy('name','ASC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.religion.crud.create');
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

        Religion::create($request->only(['name','description']));
        if ($request->_callback)
        {
            return redirect($request->_callback);
        }
        else
        {
            return redirect('religions.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function show(Religion $religion)
    {
        return view('app.resource.religion.crud.show', ['religion'=>$religion, 'renominations'=>ReligionRenomination::where('religion_id', $religion->id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function edit(Religion $religion)
    {
        return view('app.resource.religion.crud.edit',['religion'=>$religion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Religion $religion)
    {
        //dd($request->all());
        $request->validate(['name'=>'required']);

        $religion->update($request->only(['name','description']));

        if ($request->_callback)
        {
            return redirect(route($request->_callback));
        }
        else
        {
            return redirect(route('religions.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Religion  $religion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Religion $religion)
    {
        //
    }
}
