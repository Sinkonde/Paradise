<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Clas;
use App\Traits\ResultProcessor;
use App\Traits\ClassControllerVariables;

class ReportPDF extends Controller
{
    use ResultProcessor, ClassControllerVariables;

    function mkeka(Request $request){
        $data = $this->classControllerVariables($request, Clas::find(request()->class));
        return PDF::loadView('exports.pdf.mkeka.index', $data)->stream('report.pdf');
    }
}
