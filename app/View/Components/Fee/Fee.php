<?php

namespace App\View\Components\Fee;

use Illuminate\View\Component;

class Fee extends Component
{
    public $fee;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($fee)
    {
        $this->fee = $fee;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.fee.fee');
    }
}
