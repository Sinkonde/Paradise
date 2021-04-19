<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchStudent extends Component
{
    //public $students;
    use WithPagination;

    public $searchStudent = "";

    public function render()
    {
        $term = '%'.$this->searchStudent.'%';
        $students = User::whereHas('student', function($student){
            $student->where('status', 'active');
        })->where('first_name', 'like', $term)->orderBy('first_name', 'ASC')->paginate(12);

        return view('livewire.search-student', ['students'=>$students]);
    }
}
