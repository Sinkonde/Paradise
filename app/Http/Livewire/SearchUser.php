<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SearchUser extends Component
{
    use WithPagination;

    public $searchUser;
    public $view;

    public function mount(){
        $this->view = request()->view;
    }

    public function render()
    {
        $term = '%'.$this->searchUser.'%';

        if ($this->view == 'parents') {
            $users =  User::whereHas('guardian', function($guardian){
                $guardian->whereHas('my_kids', function($kids) {
                    $kids->where('student_id','!=', NULL);
                });
            });

            $users = $users->where('first_name', 'like', $term)->orderBy('first_name', 'ASC')->paginate(10);
        }
        if ($this->view == 'staff') {
            $users =  User::whereHas('guardian', function($guardian){
                $guardian->whereHas('worker', function($kids) {
                    $kids->where('guardian_id','!=', NULL);
                });
            });

            $users = $users->where('first_name', 'like', $term)->orderBy('first_name', 'ASC')->paginate(10);
        }
        else
        {
            $users =  User::whereHas('guardian', function($guardian){
                    $guardian->where('id','!=', NULL);
                });

            $users = $users->where('first_name', 'like', $term)->orderBy('first_name', 'ASC')->paginate(10);
        }

        //$users = $users->where('email', '!=', null)->where('first_name', 'like', $term)->orderBy('first_name', 'ASC')->paginate(10);

        return view('livewire.search-user', ['users'=>$users]);
    }
}
