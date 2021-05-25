<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Button extends Component
{
    public $color;
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color = 'blue', $label = 'Add')
    {
        $this->color = $color;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.button');
    }
}
