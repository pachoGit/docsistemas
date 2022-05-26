<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentosModelo;
use App\Models\EstandaresModelo;
use App\Models\EDocumentosModelo;

class Prueba extends Controller
{
    public function index()
    {
        $modelo = new EDocumentosModelo();
        $mestandar = new EstandaresModelo();
        
        // $resultado = $modelo->retDocumentosPorFechaEmision("2022-01-31",  "2022-01-31");
        
        $estandares = $mestandar->todo();
        $resultado = $modelo->retDocumentosDeEstandar($estandares->get(1)->IdEstandar);

        return $resultado->toArray();
    }
}
