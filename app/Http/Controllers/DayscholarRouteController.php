<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\DayscholarRoute;
use Illuminate\Http\Request;

class DayscholarRouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.dayscholar_route.index', ['routes'=>DayscholarRoute::orderBy('name')->get(), 'academic_year'=>AcademicYear::orderBy('created_at', 'desc')->first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.dayscholar_route.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach (explode(',',$request->name) as $name) {
            DayscholarRoute::updateOrCreate(['name'=>$name, 'description'=>$request->description??null]);
        }

        return redirect(route('routes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DayscholarRoute  $dayscholarRoute
     * @return \Illuminate\Http\Response
     */
    public function show(DayscholarRoute $dayscholarRoute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DayscholarRoute  $dayscholarRoute
     * @return \Illuminate\Http\Response
     */
    public function edit(DayscholarRoute $route)
    {
        return view('app.resource.dayscholar_route.crud.edit', ['route' => $route]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DayscholarRoute  $dayscholarRoute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayscholarRoute $route)
    {
        $route->update($request->only(['name', 'description']));
        return redirect(route('routes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DayscholarRoute  $dayscholarRoute
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayscholarRoute $route)
    {
        $route->delete();
        return back();
    }
}
