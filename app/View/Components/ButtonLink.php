<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLink extends Component
{
    public $title;
    public $color;
    public $id;
    public $name;
    public $href;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A link button',
        $color = 'green-500',
        $id = 'button',
        $name = 'button',
        $href = '#',
        $disabled = false
    ) {
        $this->title = $title;
        $this->color = $color;
        $this->id = $id;
        $this->name = $name;
        $this->href = $href;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-link');
    }
}
