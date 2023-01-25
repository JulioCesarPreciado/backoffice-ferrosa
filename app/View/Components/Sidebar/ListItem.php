<?php

namespace App\View\Components\Sidebar;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class ListItem extends Component
{
    public $title;
    public $icon;
    public $route;
    public $href;
    public $count;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A list item',
        $icon = 'fas fa-smile-beam',
        $route = 'dashboard',
        $href = 'dashboard',
        $count = null
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->href = $href;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.list-item');
    }
}
