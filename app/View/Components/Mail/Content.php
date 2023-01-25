<?php

namespace App\View\Components\Mail;

use Illuminate\View\Component;

class Content extends Component
{
    public $content;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $content = null
    ){
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $extension = pathinfo($this->content, PATHINFO_EXTENSION);

        // Formatos de imagenes admitidos
        $file_types = ['jpg', 'jpeg', 'png'];
        $type = null;

        // Revisa si el tipo de archivo del content es imagen y esta dentro de los admitidos
        if(in_array($extension, $file_types) ){
            $type = 'image';
        } elseif ($extension == 'html') {
            // Revisa si el tipo de archivo es html
            $type = 'html';
        }

        return view('components.mail.content', compact('type'));
    }
}
