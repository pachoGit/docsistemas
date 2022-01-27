<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubProcesosModelo;
use App\Models\ProcesosModelo;
use App\Models\GrupoDocumentosModelo;

class SubProceso extends Controller
{
    private $moSubProcesos = null;

    private $moProcesos = null;

    private $moGrupoDocumentos = null;

    public function __construct()
    {
        $this->moSubProcesos = new SubProcesosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
    }

    public function index()
    {
        return 'Estas en subproceso';
    }

    /**
     * Obtiene los grupos de documentos que tiene un subproceso y los envia a la vista
     *
     * @return void 
     */
    public function verGrupoDocumentos($idSubProceso)
    {
        $grupos = $this->moGrupoDocumentos->retGrupoDocumentosDeSubProceso($idSubProceso);
        $subProceso = $this->moSubProcesos->retSubProceso($idSubProceso);
        $procesoPadre = $this->moProcesos->retProceso($subProceso->IdProceso);

        return view('subproceso/ver_grupo_documentos', ['grupos'        => $grupos,
                                                        'subProceso'    => $subProceso,
                                                        'procesoPadre'  => $procesoPadre]);
    }
}
