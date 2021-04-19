<?php

namespace App\Http\Livewire\Marks;

use App\Models\Clas;
use App\Models\ClassResult;
use App\Models\Mark;
use Livewire\Component;
use App\Traits\ClassControllerVariables;
use Illuminate\Support\Facades\Auth;

class MarkManually extends Component
{
    use ClassControllerVariables;

    public $members;
    private $marks;
    //public $my_subjects = [];
    public $class;
    //public $teacher;
    public $mark;
    public $class_result;

    public function mount(){
        //set teachers subjects


        //set class and members
        if (request()->class) {
            $this->class = Clas::findOrFail(request()->class);
            $this->members = $this->getMembers($this->class->id, ['name']);
        }
        else{
            $this->class = null;
            $this->members = null;
        }

        //set marks
        if (request()->class && request()->exam) {
            $this->class_result = ClassResult::firstOrCreate(['class_id'=>request()->class, 'exam_id' => request()->exam]);
            $this->marks = Mark::where('class_result_id', $this->class_result->id);
        }
    }

    public function saveMark($class_result_id, $student_id, $subject_id, $mark){
        $mark = preg_replace('~\D~', '', $mark); //dd($mark);

        if($mark=="" or $mark < 0 or $mark > 100 or $mark == null){
            $mark = null;
        }
        Mark::updateOrCreate(['class_result_id'=>$class_result_id, 'student_id'=>$student_id, 'subject_id'=>$subject_id], ['mark'=>$mark]);
        return json_encode(['status'=>true]);

    }

    public function render()
    {
        $teacher = Auth::user()->guardian->worker->teacher;
        $subjects = $teacher->subjects;

        $my_subjects = [];
        foreach($subjects as $sub){
            if ($sub->class_subject->class_id == $this->class->id) {
                array_push($my_subjects, $sub->class_subject);
            }
        }
        return view('livewire.marks.mark-manually', ['marks'=>$this->marks, 'my_subjects' => $my_subjects, 'teacher'=>$teacher]);
    }
}
