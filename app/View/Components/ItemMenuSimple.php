<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemMenuSimple extends Component
{
    /**
     * La url donde nos redireccionara el item del menu
     *
     * @var string
     *
     */
    public $href;


    /**
     * El estado del item, puede ser 'active' o '' (cadena vacia)
     *
     * @var string
     *
     */
    public $estado;


    /**
     * El contenido que tendra el item del menu
     *
     * @var string
     *
     */
    public $contenido;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href = '#', $estado = '', $contenido = 'ItemMenuSimple')
    {
        $this->href = $href;
        $this->estado = $estado;
        $this->contenido = $contenido;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-menu-simple');
    }
}
