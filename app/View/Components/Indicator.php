<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Indicator extends Component
{
    public $name;
    public $id;
    public $color;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $color = 'red', $icon = 'fas fa-users')
    {
        $this->name = $name;
        $this->id = $id;
        $this->color = $color;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.indicator');
    }
}
