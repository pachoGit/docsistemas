<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DocPorEstandModelo;
//use App\Models\EstandaresModelo;

/**
 * Clase para consultas extras a la tabla 'Documentos'
 */
class EDocumentosModelo extends DocumentosModelo
{

    /**
     * Obtiene los documentos de una determinada fecha
     * @var $desde - Fecha en formato Date de MySQL
     * @var $hasta - Fecha en formato Date de MySQL
     * @var $tipoFecha - Valores: FechaEmision, FechaAprobacion y FechaCreacion
     * @return Collection | null
     */
    private function retDocumentosPorFecha($desde, $hasta, $tipoFecha)
    {
        $resultado = null;
        switch ($tipoFecha)
        {
            case 'FechaEmision':
                $resultado = $this->whereDate('FechaEmision', '>=', $desde)
                                  ->whereDate('FechaEmision', '<=', $hasta)
                                  ->orderBy('FechaEmision', 'desc')
                                  ->get();
                break;
            case 'FechaAprobacion':
                $resultado = $this->whereDate('FechaAprobacion', '>=', $desde)
                                  ->whereDate('FechaAprobacion', '<=', $hasta)
                                  ->orderBy('FechaAprobacion', 'desc')
                                  ->get();
                break;
            case 'FechaCreacion':
                $resultado = $this->whereDate('FechaCreacion', '>=', $desde)
                                  ->whereDate('FechaCreacion', '<=', $hasta)
                                  ->orderBy('FechaCreacion', 'desc')
                                  ->get();
                break;
        }
        return $resultado;
    }

    /**
     * Obtiene el documento por fecha de emision
     * @var $desde - Fecha en formato Date de MySQL
     * @var $hasta - Fecha en formato Date de MySQL
     * @return Collection | null
     */
    public function retDocumentosPorFechaEmision($desde, $hasta)
    {
        return $this->retDocumentosPorFecha($desde, $hasta, 'FechaEmision');
    }

    /**
     * Obtiene el documento por fecha de aprobacion
     * @var $desde - Fecha en formato Date de MySQL
     * @var $hasta - Fecha en formato Date de MySQL
     * @return Collection | null
     */
    public function retDocumentosPorFechaAprobacion($desde, $hasta)
    {
        return $this->retDocumentosPorFecha($desde, $hasta, 'FechaAprobacion');
    }

    /**
     * Obtiene el documento por fecha de creacion (fecha en el que se ha subido al sistema)
     * @var $desde - Fecha en formato Date de MySQL
     * @var $hasta - Fecha en formato Date de MySQL
     * @return Collection | null
     */
    public function retDocumentosPorFechaCreacion($desde, $hasta)
    {
        return $this->retDocumentosPorFecha($desde, $hasta, 'FechaCreacion');
    }

    /**
     * Obtiene los documentos de un determinado estandar
     * @var $idEstandar - Id del estandar
     * @return Collection
     */
    public function retDocumentosDeEstandar($idEstandar)
    {
        $moDocPorEstand = new DocPorEstandModelo();
        return $moDocPorEstand->retDocumentosDeEstandar($idEstandar);
    }
}
