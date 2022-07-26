<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DocumentosModelo;

/**
 * Modelo para controlar la tabla 'Archivos'
 *
 */
class ArchivosModelo extends Model
{
    protected $table = 'Archivos';

    protected $primaryKey = 'IdArchivo';

    protected $fillable = ['IdDocumento', 'Nombre', 'UbicacionVirtual', 'Version',
                           'FechaCreacion', 'FechaAprobacion', 'FechaModificacion',
                           'ResolucionAprobacion', 'ResolucionRectificacion', 'FechaRectificacion', 'DocumentoReferencia',
                           'MotivoCambio', 'FechaEmision', 'IdUsuario', 'Estado'];

    public $timestamps = false;

    /**
     * Obtiene todos los archivos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene un archivo determinado
     *
     * @var $idArchivo - Id del archivo
     * @return Collection
     */
    public function retArchivo($idArchivo)
    {
        return $this->where('IdArchivo', $idArchivo)
                    ->first();
    }

    /**
     * Obtiene todos los archivos de un determinado documento
     *
     * @var $idDocumento - Id del documento
     * @return Collection
     */
    public function retArchivosDeDocumento($idDocumento)
    {
        return $this->where('IdDocumento', $idDocumento)
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene un archivo determinado para ser presentado al usuario final
     *
     * @var $idArchivo - Id del archivo
     * @return Collection
     */
    public function retArchivoUsuario($idArchivo)
    {
        $archivo = $this->retArchivo($idArchivo);
        $moDocumentos = new DocumentosModelo();
        $documento = $moDocumentos->retDocumentoUsuario($archivo->IdDocumento);
        return collect([
            'IdArchivo'                 => $archivo->IdArchivo,
            'NombreArchivo'             => $archivo->Nombre,
            'UbicacionVirtualArchivo'   => $archivo->UbicacionVirtual,
            'VersionArchivo'            => $archivo->Version,
            'MotivoCambioArchivo'       => $archivo->MotivoCambio,
            'FechaCreacionArchivo'      => $archivo->FechaCreacion,
            'FechaAprobacionArchivo'    => $archivo->FechaAprobacion,
            'FechaModificacionArchivo'  => $archivo->FechaModificacion,
            'FechaEmisionArchivo'       => $archivo->FechaEmision,

            'ResolucionAprobacionArchivo'    => $archivo->ResolucionAprobacion,
            'ResolucionRectificacionArchivo' => $archivo->ResolucionRectificacion,
            'FechaRectificacionArchivo'      => $archivo->FechaRectificacion,
            'DocumentoReferenciaArchivo'     => $archivo->DocumentoReferencia,

            'EstadoArchivo'             => $archivo->Estado,
        ])->merge($documento);
    }
}

