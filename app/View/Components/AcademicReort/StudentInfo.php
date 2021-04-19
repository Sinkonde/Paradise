<?php

namespace App\View\Components\AcademicReort;

use App\Models\ClassMember;
use Illuminate\View\Component;

class StudentInfo extends Component
{
    public $student;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        $this->student = ClassMember::findOrFail($student);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.academic-reort.student-info');
    }
}
