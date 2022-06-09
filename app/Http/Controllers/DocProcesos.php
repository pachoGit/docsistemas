<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentosModelo;
use App\Models\EDocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;


class DocProcesos extends Controller
{
    private $moEDocumentos = null;
    
    private $moDocumentos = null;

    private $moProcesos = null;

    private $moSubProcesos = null;

    public function __construct()
    {
        $this->moEDocumentos = new EDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moSubProcesos = new SubProcesosModelo();
    }

    public function inicio()
    {
        $procesosGenerales = $this->moProcesos->todo();
        $infoProcesos = collect([]);
        foreach ($procesosGenerales as $procesoGeneral)
        {
            $proceso = $this->moProcesos->retProcesoUsuario($procesoGeneral->IdProceso);
            $proceso = $proceso->merge(['CantidadDocumentos' => $this->retCantidadDocumentosDeProceso($procesoGeneral)]);
            $infoProcesos->push($proceso);
        }
        $data = ['procesos' => $infoProcesos];
        return view('docprocesos/inicio', $data);
    }

    public function documentos($idProceso)
    {
        $documentos = $this->moDocumentos->retDocumentosDeProceso($idProceso);
        $proceso = $this->moProcesos->retProcesoUsuario($idProceso);

        $infoDocumentos = collect([]);
        foreach ($documentos as $documento)
            $infoDocumentos->push($this->moDocumentos->retDocumentoUsuario($documento->IdDocumento));
        $data = [
            'documentos' => $infoDocumentos,
            'proceso'    => $proceso
        ];
        return view('docprocesos/documentos', $data);
    }

    public function ver($idDocumento, $idProceso)
    {
        $documento = $this->moDocumentos->retDocumentoUsuario($idDocumento);
        $subProceso = $this->moSubProcesos->retSubProceso($documento->get('IdSubProceso'));
        $procesoPadre = $this->moProcesos->retProceso($subProceso->IdProceso);
        $data = ['documento'    => $documento,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'redireccion'  => ['ruta' => 'docprocesos-documentos', 'id' => $idProceso]];
        return view ('documentos/ver', $data);
    }

    /**
     * Obtiene la cantidad de documentos de un determinado proceso general
     *
     * @var $procesoGeneral - Collection con la información del proceso
     * @return int
     */
    private function retCantidadDocumentosDeProceso($procesoGeneral)
    {
        $subProcesos = $this->moSubProcesos->retSubProcesosDeProceso($procesoGeneral->IdProceso);
        $ndocumentos = 0;
        foreach ($subProcesos as $subProceso)
            $ndocumentos += $this->moDocumentos->retDocumentosDeSubProceso($subProceso->IdSubProceso)->count();
        return $ndocumentos;
    }
}
