<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select2 extends Component
{
    public $id;
    public $name;
    public $title;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $title, $class="")
    {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select2');
    }
}
