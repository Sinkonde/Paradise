<?php

namespace App\Http\Controllers;

use App\Models\AcademicAwardWinner;
use Illuminate\Http\Request;

class AcademicAwardWinnerController extends Controller
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
        if ($request->_many == 'many' and is_array($request->winners)) {
            foreach ($request->winners as $key => $value) {
                AcademicAwardWinner::create($request->only(['academic_award_id'])+['user_id'=>$value]);
            }
        }
        else{
            $request->validate(['student_id' => 'required', 'academic_award_id' => 'required']);
            AcademicAwardWinner::create($request->only(['user_id','academic_award_id']));
            return back()->with('success','Successfully awarded!!');
        }

        return back()->with('success', 'Winners were created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicAwardWinner  $academicAwardWinner
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicAwardWinner $academicAwardWinner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicAwardWinner  $academicAwardWinner
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicAwardWinner $academicAwardWinner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicAwardWinner  $academicAwardWinner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicAwardWinner $academicAwardWinner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicAwardWinner  $academicAwardWinner
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicAwardWinner $academicAwardWinner)
    {
        $academicAwardWinner->delete();
        return back()->with('success','Successfully deleted!!');
    }
}
