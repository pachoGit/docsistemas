<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alerta extends Component
{
    /**
     * Tipo de alerta
     *
     * @var string
     */
    public $tipo;

    /**
     * Titulo de la alerta
     *
     * @var string
     */
    public $titulo;

    /**
     * Icono de la alerta (dependera del tipo de alerta)
     *
     * @var string
     */
    public $icono;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tipo = '', $titulo = 'Titulo', $icono = '')
    {
        $this->tipo = $tipo;
        $this->titulo = $titulo;
        if ($this->tipo === 'danger')
            $this->icono = 'ban';
        else if ($this->tipo === 'info')
            $this->icono = 'info';
        else if ($this->tipo === 'warning')
            $this->icono = 'exclamation-triangle';
        else if ($this->tipo === 'success')
            $this->icono = 'check';
        else
            $this->icono = $icono; // Por defecto (lo que esta en el constructor)
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alerta');
    }
}
