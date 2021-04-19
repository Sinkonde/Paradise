<?php

namespace App\Http\Controllers;

use App\Traits\ClassControllerVariables;
use App\Traits\WelcomeVariables;
use Illuminate\Http\Request;
use PDF;

class HomeController extends Controller
{
    /**
     * Get the neccesary variables.
     *
     */
    use WelcomeVariables, ClassControllerVariables;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->homeVariables());
        return view('home', $this->homeVariables());
    }

    public function pdf(){
        $data = [
			'foo' => 'bar'
		];
		$pdf = PDF::loadView('exports.pdf.document', $data);
		return $pdf->stream('document.pdf');
    }
}
