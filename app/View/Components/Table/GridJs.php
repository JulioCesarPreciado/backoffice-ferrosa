<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class GridJs extends Component
{
    public $id;
    public $title;
    public $icon;
    public $url;
    public $parameter;
    public $create;
    public $show;
    public $edit;
    public $delete;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = 'wrapper',
        $title = 'A title',
        $icon = 'fas fa-smile-beam',
        $url = null,
        $parameter = null,
        $create = true,
        $show = true,
        $edit = true,
        $delete = true
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->icon = $icon;
        $this->url = $url;
        $this->parameter = $parameter;
        $this->create = $create;
        $this->show = $show;
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
        return view('components.table.grid-js');
    }
}
