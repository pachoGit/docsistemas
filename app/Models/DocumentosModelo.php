<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\Models\GrupoDocumentosModelo;
use App\Models\TipoDocumentoModelo;
use App\Models\UnidadesModelo;
use App\Models\DocPorEstandModelo;
use App\Models\SubProcesosModelo;
use App\Models\ProcesosModelo;
use App\Models\EstandaresModelo;

/**
 * Modelo para controlar la tabla 'Documentos'
 *
 */
class DocumentosModelo extends Model
{
    protected $table = 'Documentos';

    protected $primaryKey = 'IdDocumento';

    protected $fillable = ['IdGrupoDocumento', 'IdTipoDocumento', 'IdUnidad', 'Codigo',
                           'Nombre', 'UbicacionVirtual', 'UbicacionFisica', 'Version', 'MotivoEliminado',
                           'FechaAprobacion', 'FechaCreacion', 'FechaEmision', 'Estado'];

    public $timestamps = false;
    
    /**
     * Obtiene todos los documentos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene un documento determinado
     *
     * @var $idDocumento - Id del registro
     * @return Collection
     */
    public function retDocumento($idDocumento)
    {
        return $this->where('IdDocumento', $idDocumento)
                    ->first();
    }

    /**
     * Obtiene los documentos de un determinado grupo de documentos
     *
     * @var $idGrupoDocumento - Id del grupo de documento
     * @return Collection
     */
    public function retDocumentosDeGrupo($idGrupoDocumento)
    {
        return $this->where('IdGrupoDocumento', $idGrupoDocumento)
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene los documentos de un determinado tipo de documentos
     *
     * @var $idTipoDocumento - Id del tipo de documento
     * @return Collection
     */
    public function retDocumentosDeTipo($idTipoDocumento)
    {
        return $this->where('IdTipoDocumento', $idTipoDocumento)
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene los documentos de una determinada unidad de documentos
     *
     * @var $idUnidad - Id de la unidad de documento
     * @return Collection
     */
    public function retDocumentosDeUnidad($idUnidad)
    {
        return $this->where('IdUnidad', $idUnidad)
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene los documentos de una determinada subproceso
     *
     * @var $idSubProceso - Id del subproceso
     * @return Collection
     */
    public function retDocumentosDeSubProceso($idSubProceso)
    {
        // Obtenemos todos los grupos que pertenecen al subproceso
        $moGrupoDocumentos = new GrupoDocumentosModelo();
        $grupos = $moGrupoDocumentos->retGrupoDocumentosDeSubProceso($idSubProceso);
        $documentos = collect([]);
        // De cada grupo, obtenemos los documentos que tienen alojados
        foreach ($grupos as $grupo)
            $documentos->push($this->retDocumentosDeGrupo($grupo->IdGrupoDocumento));
        return $documentos->collapse();
    }

    /**
     * Obtiene los documentos de una determinada proceso
     *
     * @var $idProceso - Id del proceso
     * @return Collection
     */
    public function retDocumentosDeProceso($idProceso)
    {
        $moSubProceso = new SubProcesosModelo();
        $subProcesos = $moSubProceso->retSubProcesosDeProceso($idProceso);
        $documentos = collect([]);
        foreach ($subProcesos as $subProceso)
            $documentos->push($this->retDocumentosDeSubProceso($subProceso->IdSubProceso));
        return $documentos->collapse();
    }

    /**
     * Obtiene un documento para ser presentado al usuario final
     *
     * @return Collection
     */
    public function retDocumentoUsuario($idDocumento)
    {
        $documento = $this->retDocumento($idDocumento);
        $moGrupoDocumentos = new GrupoDocumentosModelo();
        $moTipoDocumento = new TipoDocumentoModelo();
        $moUnidades = new UnidadesModelo();
        $moDocPorEstand = new DocPorEstandModelo();
        $grupo = $moGrupoDocumentos->retGrupoDocumentoUsuario($documento->IdGrupoDocumento);
        $tipo = $moTipoDocumento->retTipoDocumentoUsuario($documento->IdTipoDocumento);
        $unidad = $moUnidades->retUnidadUsuario($documento->IdUnidad);
        
        $estandares = $moDocPorEstand->retEstandaresDeDocumento($idDocumento);
        $moEstandares = new EstandaresModelo();
        $estandaresUsuario = collect([]);
        foreach ($estandares as $estandar)
            $estandaresUsuario->push($moEstandares->retEstandarUsuario($estandar->IdEstandar));

        return collect([
            'IdDocumento'                 => $documento->IdDocumento,
            'CodigoDocumento'             => $documento->Codigo,
            'NombreDocumento'             => $documento->Nombre,
            'UbicacionVirtualDocumento'   => $documento->UbicacionVirtual,
            'UbicacionFisicaDocumento'    => $documento->UbicacionFisica,
            'VersionDocumento'            => $documento->Version,
            'MotivoEliminadoDocumento'    => $documento->MotivoEliminado,
            'FechaAprobacionDocumento'    => $documento->FechaAprobacion,
            'FechaCreacionDocumento'      => $documento->FechaCreacion,
            'FechaEmisionDocumento'       => $documento->FechaEmision,
            'EstadoDocumento'             => $documento->Estado,
            'EstandaresDocumento'         => $estandaresUsuario,
        ])->merge($grupo)->merge($tipo)->merge($unidad);
    }
}
