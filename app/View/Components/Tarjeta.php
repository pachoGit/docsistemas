<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Tarjeta extends Component
{
    /**
     * Titulo de la tarjeta
     *
     * @var string
     */
    public $titulo;

    /**
     * Descripcion de la tarjeta
     *
     * @var string
     *
     */
    public $descripcion;

    /**
     * Tipo de la tarjeta (determina mas que nada el color)
     *
     * @var string
     *
     */
    public $tipo;

    /**
     * Id del modal que mostrara el boton de editar
     *
     * @var int
     *
     */
    public $idModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($titulo = 'titulo', $descripcion = 'descripcion',  $tipo = 'info', $idModal = 0)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->idModal = $idModal;
        $this->tipo = $tipo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tarjeta');
    }
}
