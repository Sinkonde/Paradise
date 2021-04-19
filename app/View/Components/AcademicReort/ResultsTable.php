<?php

namespace App\View\Components\AcademicReort;

use App\Models\Subject;
use Illuminate\View\Component;

class ResultsTable extends Component
{
    public $results;
    public $report;
    public $totalStudents;
    public $student;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($results, $report, $totalStudents, $student)
    {
        $this->results = $results;
        $this->report = $report;
        $this->totalStudents = $totalStudents;
        $this->student = $student;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.academic-reort.results-table');
    }
}
