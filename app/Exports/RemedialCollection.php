<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RemedialCollection implements FromView
{
    public $students;
    public $class;

    public function __construct($students, $class)
    {
        $this->students = $students;
        $this->class = $class;
    }

    public function view(): View
    {
        return view('exports.excel.remedial_collection', ['students'=>$this->students, 'class'=>$this->class]);
    }
}
