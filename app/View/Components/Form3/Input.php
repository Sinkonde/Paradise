<?php

namespace App\View\Components\form;

use Illuminate\View\Component;

class Input extends Component
{
    public $classes;
    public $name;
    public $type;
    public $color;
    public $value;
    public $label;
    public $readonly;
    public $select;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($select = "", $readonly = "", $value="", $classes="", $name="", $type="text", $color="gray", $label="Name")
    {
        $this->classes = $classes;
        $this->name = $name;
        $this->type = $type;
        $this->color = $color;
        $this->value = $value;
        $this->label = $label;
        $this->readonly = $readonly;
        $this->select = $select;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
