<?php

namespace App\View\Components\Mail;

use Illuminate\View\Component;

class Footer extends Component
{
    public $email;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $email = 'mail@mail.com'
    ) {
        $this->email = $email;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mail.footer');
    }
}
