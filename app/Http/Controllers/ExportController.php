<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MarksTemplate;
use App\Exports\RemedialCollection;
use App\Exports\StudentTemplate;
use App\Traits\ClassControllerVariables;

class ExportController extends Controller
{
    use ClassControllerVariables;

    public function resultTemplate(Request $request){
        $class = Clas::findOrFail($request->class);
        return Excel::download(new MarksTemplate($class), 'Class '.$class->grade->name.'-'.$class->stream->name.' template - ('.$class->academic_year->year.').xlsx');
    }

    public function remedialCollectionTemplate(Clas $class){

        return Excel::download(new RemedialCollection($this->getMembers($this->getOtherClassesIdsFromClass($class), ['name']),$class), 'Class '.$class->grade->name.' Remedial template - ('.$class->academic_year->year.').xlsx');
    }

    public function studentTempalate(){

        return Excel::download(new StudentTemplate(), 'student_template.xlsx');
    }
}
