<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentosModelo;
use App\Models\EstandaresModelo;
use App\Models\EDocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;

/**
 * Clase para controlar los reportes de documentos filtrados por estandar
 * NOTA: Es la parte "Documentos por estandar" del menu de la página web :D
 */
class DocEstandar extends Controller
{
    private $moEstandares = null;

    private $moEDocumentos = null;
    
    private $moDocumentos = null;

    private $moProcesos = null;

    private $moSubProcesos = null;

    public function __construct()
    {
        $this->moEstandares = new EstandaresModelo();
        $this->moEDocumentos = new EDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moSubProcesos = new SubProcesosModelo();
    }

    /**
     * Listar todos los estandares con la cantidad de documentos que se enlazan
     *
     * @return view = string
     */
    public function todos()
    {
        $estandares = $this->moEstandares->todo();
        
        // Obtenemos información de los estandares
        $infoEstandares = collect([]);
        foreach ($estandares as $estandar)
        {
            $uestandar = $this->moEstandares->retEstandarUsuario($estandar->IdEstandar);
            $uestandar = $uestandar->merge(["CantidadDocumentos" => $this->moEDocumentos->retDocumentosDeEstandar($estandar->IdEstandar)->count()]);
            $infoEstandares->push($uestandar);
        }

        $data = ['estandares'   => $infoEstandares];
        return view('docestandar/todos', $data);
    }

    /**
     * Listar los documentos que pertenecen a un estadar específico
     *
     * @param $idEstandar - Id del estandar
     * @return view = string
     */
    public function documentos($idEstandar)
    {
        $documentos = $this->moEDocumentos->retDocumentosDeEstandar($idEstandar);
        $estandar = $this->moEstandares->retEstandarUsuario($idEstandar);
        //return $documentos->all();

        $infoDocumentos = collect([]);
        foreach ($documentos as $documento)
            $infoDocumentos->push($this->moDocumentos->retDocumentoUsuario($documento->IdDocumento));
        
        //return $infoDocumentos->first()->all();

        $data = ['documentos'   => $infoDocumentos,
                 'estandar'     => $estandar];
        return view('docestandar/documentos', $data);
    }

    /**
     * Ver la información de un documento
     *
     * @param $idDocumento - Id del documento
     * @param $idEstandar - Id del estandar: Sirve para redireccionar de la vista de "ver documento"
     *                      hacia la vista que vamos a definir (ya que por defecto el "boton de volver"
     *                      de la vista de "ver documento" redirige hacia otra ruta
     * @return view = string
     */
    public function ver($idDocumento, $idEstandar)
    {
        $documento = $this->moDocumentos->retDocumentoUsuario($idDocumento);
        $subProceso = $this->moSubProcesos->retSubProceso($documento->get('IdSubProceso'));
        $procesoPadre = $this->moProcesos->retProceso($subProceso->IdProceso);

        $data = ['documento'    => $documento,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'redireccion'  => ['ruta' => 'docestandar-documentos', 'id' => $idEstandar]];
        return view ('documentos/ver', $data);
    }
}
