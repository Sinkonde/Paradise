<?php

namespace App\View\Components\Home;

use Illuminate\View\Component;

class InfoCard extends Component
{
    public $title;
    public $count;
    public $color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title="students", $count="306", $color="teal")
    {
        $this->title = $title;
        $this->count = $count;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.home.info-card');
    }
}
