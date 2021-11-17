<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\ProcesosModelo;
use App\Models\DocumentosModelo;

class Inicio extends Controller
{
    private $moProcesos = null;

    private $moDocumentos = null;
    
    public function __construct()
    {
        $this->moProcesos = new ProcesosModelo();
        $this->moDocumentos = new DocumentosModelo();
    }
               
    public function index()
    {
        $this->generarDataDefecto();
        $ndocumentos = $this->moDocumentos->todo()->count();
        $data = ['ndocumentos' => $ndocumentos];
        return view('inicio', $data);
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

