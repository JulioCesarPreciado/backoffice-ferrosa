<?php

namespace App\View\Components\Sidebar;

use Illuminate\View\Component;

class UnorderedList extends Component
{
    public $title;
    public $icon;
    public $route;
    public $routes;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A list item',
        $icon = 'fas fa-smile-beam',
        $route = 'dashboard',
        $routes = []
    ) {
        $this->title = $title;
        $this->icon = $icon;
        $this->route = $route;
        $this->routes = $routes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar.unordered-list');
    }
}
