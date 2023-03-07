<?php

namespace App\View\Components;

use App\Models\Reviews;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $route;
    public $review;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->route = Route::current()->getName();
        $this->review = Reviews::where('validity', 'PENDING')->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
