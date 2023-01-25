<?php

namespace App\View\Components\Mail;

use Illuminate\View\Component;

class Header extends Component
{
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A header title'
    ) {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mail.header');
    }
}
