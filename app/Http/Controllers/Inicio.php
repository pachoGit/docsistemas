<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\ProcesosModelo;

class Inicio extends Controller
{
    private $moProcesos = null;

    public function __construct()
    {
        $this->moProcesos = new ProcesosModelo();
    }
               
    public function index()
    {
        // Generamos los datos que siempre estan disponibles en todas las vistas
        $this->generarDataDefecto();
        return view('inicio');
    }

    /**
     * Genera la informacion que siempre se debe mostrar, es decir, que solo se necesita
     * realizar una sola consulta a la base datos. Ademas guarda los datos en variable
     * global 'session', por ahora solo guarda los datos del menu de la pagina.
     *
     * @return void
     */
    private function generarDataDefecto()
    {
        $procesos = $this->moProcesos->todo();
        // Datos necesarios para mostrar el menu
        $menu = [];
        foreach ($procesos as $proceso)
        {
            // Obtenemos todos los subprocesos del proceso actual
            $subs = $procesos->find($proceso->IdProceso)->subProcesos;
            // toArray elimina los datos innecesarios de la clase Collection
            $menu[$proceso->Nombre] = $subs->toArray();
        }
        session(['menu' => $menu]);
    }
}

