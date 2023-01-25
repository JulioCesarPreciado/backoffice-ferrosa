<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Crud extends Component
{
    public $title;
    public $icon;
    public $route;
    public $form;
    public $item;
    public $create;
    public $show;
    public $edit;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A text input',
        $icon = 'fas fa-smile-beam',
        $route = null,
        $form = null,
        $item = null,
        $create = false,
        $show = false,
        $edit = false
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->form = $form;
        $this->item = $item;
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
        return view('components.crud');
    }
}
