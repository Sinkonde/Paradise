<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\FeesCategory;
use Illuminate\Http\Request;

class FeesCategoryController extends Controller
{
    public $academic_year;

    function __construct()
    {
        $this->academic_year = AcademicYear::orderBy('created_at', 'desc')->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (is_null($this->academic_year)) {
            redirect(route('academic_year.create'));
        }
        $academic_year = $this->academic_year;
        return view('app.resource.fees_category.index', ['fees_categories' => FeesCategory::all(), 'academic_year' => $academic_year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fees_category_year_id = $this->academic_year;
        return view('app.resource.fees_category.crud.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categories = explode(',', $request->name);

            foreach ($categories as $category) {
                FeesCategory::create(['name' => $category]);
            }

            if($request->callback){
                return redirect($request->callback);
            }

        return redirect(route('fees-categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FeesCategory  $feesCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FeesCategory $fees_category)
    {
        return view('app.resource.fees_category.crud.show',['fees_category'=>$fees_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FeesCategory  $feesCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FeesCategory $fees_category)
    {
        return view('app.resource.fees_category.crud.edit',['fees_category'=>$fees_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FeesCategory  $feesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeesCategory $fees_category)
    {
        $fees_category->update($request->only(['name', 'description']));

        if($request->callback){
            return redirect($request->callback);
        }
        return redirect(route('fees-categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FeesCategory  $feesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeesCategory $fees_category)
    {
        $fees_category->delete();
        if(request()->callback){
            return redirect(request()->callback);
        }
        return redirect(route('fees-categories.index'));
    }
}
