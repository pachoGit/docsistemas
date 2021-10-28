<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GrupoDocumentosModelo;
use App\Models\DocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;
use App\Models\TipoDocumentoModelo;
use App\Models\UnidadesModelo;

class Documentos extends Controller
{
    private $moGrupoDocumentos = null;

    private $moDocumentos = null;

    private $moProcesos = null;

    private $moSubProcesos = null;

    private $moTipoDocumento = null;

    private $moUnidades = null;

    public function __construct()
    {
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moSubProcesos = new SubProcesosModelo();
        $this->moTipoDocumento = new TipoDocumentoModelo();
        $this->moUnidades = new UnidadesModelo();
    }

    /**
     * Ver los Documentos de un determinado Grupo de Documentos
     *
     * @param $idGrupoDocumento - El ID del grupo de documento
     *
     * @return view
     *
     */
    public function todos($idGrupoDocumento)
    {
        $documentos = $this->moGrupoDocumentos->find($idGrupoDocumento)->documentos;
        $grupo = $this->moGrupoDocumentos->find($idGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        return view('documentos/todos', ['documentos'   => $documentos,
                                         'grupo'        => $grupo,
                                         'subProceso'   => $subProceso,
                                         'procesoPadre' => $procesoPadre]);
    }

    public function ver()
    {
        
    }

    public function crear(Request $solicitud, $idGrupoDocumento)
    {
        
    }

    public function editar()
    {
        
    }

    public function eliminar()
    {
        
    }

    public function vistaCrear($idGrupoDocumento)
    {
        $grupo = $this->moGrupoDocumentos->find($idGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        $tipoDocumento = $this->moTipoDocumento->todo();
        $unidades = $this->moUnidades->todo();

        $data = ['grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'tipos'        => $tipoDocumento,
                 'unidades'     => $unidades];

        return view('documentos/crear', $data);
    }
}
