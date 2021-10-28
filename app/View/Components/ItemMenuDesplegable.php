<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ItemMenuDesplegable extends Component
{
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
     * El icono que tendra el item del menu
     *
     * @var string
     *
     */
    public $icono;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($estado = '', $contenido = 'contenido', $icono  = '')
    {
        $this->estado = $estado;
        $this->contenido = $contenido;
        $this->icono = $icono;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.item-menu-desplegable');
    }
}
