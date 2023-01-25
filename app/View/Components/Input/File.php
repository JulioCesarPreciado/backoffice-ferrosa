<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class File extends Component
{
    public $id;
    public $name;
    public $title;
    public $value;
    public $required;
    public $readonly;
    public $accept;
    public $create;
    public $show;
    public $edit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = 'file_input',
        $name = 'file_input',
        $title = 'A file input',
        $value = null,
        $required = false,
        $readonly = false,
        $accept = '*',
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
        $this->accept = $accept;
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
        return view('components.input.file');
    }
}
