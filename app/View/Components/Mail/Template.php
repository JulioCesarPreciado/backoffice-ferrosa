<?php

namespace App\View\Components\Mail;

use Illuminate\View\Component;

class Template extends Component
{
    public $title;
    public $email;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $title = 'A header titles',
        $email = 'mail@mail.com',
        $content = 'A content'
    ) {
        $this->title = $title;
        $this->email = $email;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mail.template');
    }
}
