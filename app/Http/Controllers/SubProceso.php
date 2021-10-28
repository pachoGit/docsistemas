<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubProcesosModelo;
use App\Models\ProcesosModelo;

class SubProceso extends Controller
{
    private $moSubProcesos = null;

    private $moProcesos = null;

    public function __construct()
    {
        $this->moSubProcesos = new SubProcesosModelo();
        $this->moProcesos = new ProcesosModelo();
    }

    public function index()
    {
        return 'Estas en subproceso';
    }

    /**
     * Obtiene los grupos de documentos que tiene un subproceso y los envia a la vista
     *
     * @return void 
     *
     */
    public function verGrupoDocumentos($idSubProceso)
    {
        $grupos = $this->moSubProcesos->find($idSubProceso)->grupoDocumentos;
        $subProceso = $this->moSubProcesos->find($idSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);

        return view('subproceso/ver_grupo_documentos', ['grupos'        => $grupos,
                                                        'subProceso'    => $subProceso,
                                                        'procesoPadre'  => $procesoPadre]);
    }
}
