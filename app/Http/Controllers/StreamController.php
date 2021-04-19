<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Stream;
use Illuminate\Http\Request;

class StreamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $level_name = Stream::where('level_id', $request->for_level)->first() ? Stream::where('level_id', $request->for_level)->first()->level->name :null;

        $streams = $level_name ? Stream::where('level_id', $request->for_level)->orderBy('name','ASC')->get() : Stream::orderBy('name','ASC')->get();
        return view('app.resource.stream.index', ['streams' => $streams, 'level_name' =>$level_name, 'levels' => Level::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $for_level = Level::find($request->for_level) ? Level::find($request->for_level) : null;
        return view('app.resource.stream.crud.create', ['levels' => Level::all(), 'for_level' => $for_level]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'level_id' =>'required']);
        $streams = explode(',', $request->name);

        foreach ($streams as $stream) {
            Stream::create(['name' => $stream, 'level_id' => $request->level_id]);
        }

        if($request->callback){
            return redirect($request->callback);
        }

        return redirect(route('streams.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function show(Stream $stream)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function edit(Stream $stream)
    {
        return view('app.resource.stream.crud.edit', ['levels' =>Level::all(), 'stream' => $stream]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stream $stream)
    {
        $request->validate(['name' => 'required', 'level_id' =>'required']);
        $stream->update($request->input());
        return redirect(route('streams.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stream  $stream
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stream $stream)
    {
        $stream->delete();
        return redirect(route('streams.index'));
    }
}
