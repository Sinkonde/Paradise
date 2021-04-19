<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MarksTemplate implements FromView
{
    public $students;

    public function __construct($students)
    {
        $this->students = $students;
    }

    public function view(): View
    {
        return view('exports.excel.marks-template', ['class'=>$this->students]);
    }
}
