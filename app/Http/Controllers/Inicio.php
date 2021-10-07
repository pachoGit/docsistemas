<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcesosModelo;

class Inicio extends Controller
{
    //private $m_procesos = new ProcesosModelo();
    private $m_procesos = null;

    public function __construct()
    {
        $this->m_procesos = new ProcesosModelo();
    }
               
    public function index()
    {
        $procesos = $this->m_procesos->todo();
        session(['procesos' => $procesos]);

        return view('inicio');
        
    }
}

