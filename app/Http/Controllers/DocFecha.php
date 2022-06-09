<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentosModelo;
use App\Models\EstandaresModelo;
use App\Models\EDocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;

/**
 * Clase para controlar los reportes de documentos filtrados por fecha
 * NOTA: Es la parte "Documentos por fecha" del menu de la página web :D
 */
class DocFecha extends Controller
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
        return view('docfecha/inicio');
    }

    /**
     * Obtiene los documentos de acuerdo a la entrada del usuario
     *
     * @return view - String
     */
    public function documentos(Request $solicitud)
    {
        $fechaInicio = $solicitud->input('fecha-inicio');
        $fechaFin = $solicitud->input('fecha-fin');
        $tipoFecha = $solicitud->input('tipo-fecha');
        
        $documentos = [];
        if ($tipoFecha === '1')
            $documentos = $this->moEDocumentos->retDocumentosPorFechaEmision($fechaInicio, $fechaFin);
        elseif ($tipoFecha === '2')
            $documentos = $this->moEDocumentos->retDocumentosPorFechaAprobacion($fechaInicio, $fechaFin);
        else // '3'
            $documentos = $this->moEDocumentos->retDocumentosPorFechaCreacion($fechaInicio, $fechaFin);

        $infoDocumentos = collect([]);
        foreach ($documentos as $documento)
            $infoDocumentos->push($this->moDocumentos->retDocumentoUsuario($documento->IdDocumento));

        $data = [
            'documentos'   => $infoDocumentos,
            'fechaInicio'  => $fechaInicio,
            'fechaFin'     => $fechaFin,
            'tipoFecha'    => $tipoFecha
        ];
        return view('docfecha/inicio', $data);
    }

    public function ver($idDocumento)
    {
        $documento = $this->moDocumentos->retDocumentoUsuario($idDocumento);
        $subProceso = $this->moSubProcesos->retSubProceso($documento->get('IdSubProceso'));
        $procesoPadre = $this->moProcesos->retProceso($subProceso->IdProceso);

        $data = ['documento'   => $documento,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'redireccion' => ['ruta' => 'docfecha-inicio', 'id' => '']];
        return view ('documentos/ver', $data);
    }
}
