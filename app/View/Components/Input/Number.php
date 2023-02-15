<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Number extends Component
{
    public $id;
    public $name;
    public $title;
    public $value;
    public $required;
    public $readonly;
    public $create;
    public $show;
    public $edit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = 'number_input',
        $name = 'number_input',
        $title = 'A number input',
        $value = 'A number value',
        $required = false,
        $readonly = false,
        $create = false,
        $show = false,
        $edit = false
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->create = $create;
        $this->show = $show;
        $this->edit = $edit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.number');
    }
}
