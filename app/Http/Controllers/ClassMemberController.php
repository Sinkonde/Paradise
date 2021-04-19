<?php

namespace App\Http\Controllers;

use App\Models\ClassMember;
use Illuminate\Http\Request;

class ClassMemberController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassMember  $classMember
     * @return \Illuminate\Http\Response
     */
    public function show(ClassMember $classMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassMember  $classMember
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassMember $classMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClassMember  $classMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassMember $classMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassMember  $classMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassMember $member)
    {
        $member->update(['deleted_at'=> date('Y-m-d h:i:s')]);
        return back();
    }
}
