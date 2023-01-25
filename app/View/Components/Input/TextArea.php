<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $id;
    public $name;
    public $title;
    public $value;
    public $cols;
    public $rows;
    public $required;
    public $readonly;
    public $create;
    public $show;
    public $edit;
    public $maxlength;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = 'text_input',
        $name = 'text_input',
        $title = 'A text input',
        $value = 'A text value',
        $cols = '10',
        $rows = '3',
        $required = false,
        $readonly = false,
        $create = false,
        $show = false,
        $edit = false,
        $maxlength = 50,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->required = $required;
        $this->readonly = $readonly;
        $this->create = $create;
        $this->show = $show;
        $this->edit = $edit;
        $this->maxlength = $maxlength;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.text-area');
    }
}
