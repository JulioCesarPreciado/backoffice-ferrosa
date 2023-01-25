<?php

namespace App\View\Components;

use Illuminate\View\Component;

class jsGrid extends Component
{
    public $title;
    public $icon;
    public $url;
    public $parameter;
    public $create;
    public $edit;
    public $delete;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $icon, $url, $parameter, $create=false, $edit=false, $delete=false)
    {
        $this->title = $title;
        $this->icon = $icon;
        $this->url = $url;
        $this->parameter = $parameter;
        $this->create = $create;
        $this->edit = $edit;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|strings
     */
    public function render()
    {
        return view('components.js-grid');
    }
}
