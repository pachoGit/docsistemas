<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'Documentos'
 *
 */
class DocumentosModelo extends Model
{
    protected $table = 'Documentos';

    protected $primaryKey = 'IdDocumento';

    protected $fillable = ['IdGrupoDocumento', 'IdTipoDocumento', 'IdUnidad', 'Codigo',
                           'Nombre', 'UbicacionVirtual', 'UbicacionFisica', 'Version',
                           'FechaAprovacion', 'FechaCreacion', 'Estado'];

    public $timestamps = false;
    
    /**
     * Obtiene todos los datos en bruto con 'Estado = 1'
     *
     * @return Collection
     *
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene todos los documentos de un grupo de documentos, para ser presentados
     * al usuario final. Se envian todos, con todo los de Estado = 0
     *
     * @var $idGrupoDocumento - Id del grupo de documento
     *
     * @return Collection
     *
     */
    public function presentarTodos($idGrupoDocumento)
    {
        return $this->where('GrupoDocumentos.IdGrupoDocumento', $idGrupoDocumento)
                    ->join('TipoDocumento',   'Documentos.IdTipoDocumento',  '=', 'TipoDocumento.IdTipoDocumento')
                    ->join('Unidades',        'Documentos.IdUnidad',         '=', 'Unidades.IdUnidad')
                    ->join('GrupoDocumentos', 'Documentos.IdGrupoDocumento', '=', 'GrupoDocumentos.IdGrupoDocumento')
                    ->select('Documentos.Nombre',
                             'Unidades.Nombre as Unidad',
                             'TipoDocumento.Nombre as Tipo',
                             'Documentos.IdDocumento',
                             'Documentos.IdGrupoDocumento',
                             'Documentos.Codigo',
                             'Documentos.UbicacionVirtual',
                             'Documentos.UbicacionFisica',
                             'Documentos.Version',
                             'Documentos.FechaAprovacion',
                             'Documentos.FechaCreacion',
                             'Documentos.Estado')
                    ->orderBy('Documentos.FechaCreacion', 'desc')
                    ->get();
    }

    /**
     * Obtiene la información de un documento, para ser mostrados
     * al usuario final.
     *
     * @var $idDocumento - Id del documento que se desea mostrar
     *
     * @return Collection
     *
     */
    public function presentarDe($idDocumento)
    {
        return $this->select('Unidades.Nombre as Unidad',
                             'TipoDocumento.Nombre as Tipo',
                             'GrupoDocumentos.Nombre as Grupo',
                             'SubProcesos.Nombre as SubProceso',
                             'Procesos.Nombre as Proceso',
                             'Documentos.IdDocumento',
                             'Documentos.IdGrupoDocumento',
                             'Documentos.Codigo',
                             'Documentos.Nombre',
                             'Documentos.UbicacionVirtual',
                             'Documentos.UbicacionFisica',
                             'Documentos.Version',
                             'Documentos.FechaAprovacion',
                             'Documentos.FechaCreacion',
                             'Documentos.Estado')
                    ->join('TipoDocumento',   'Documentos.IdTipoDocumento',   '=', 'TipoDocumento.IdTipoDocumento')
                    ->join('Unidades',        'Documentos.IdUnidad',          '=', 'Unidades.IdUnidad')
                    ->join('GrupoDocumentos', 'Documentos.IdGrupoDocumento',  '=', 'GrupoDocumentos.IdGrupoDocumento')
                    ->join('SubProcesos',     'GrupoDocumentos.IdSubProceso', '=', 'SubProcesos.IdSubProceso')
                    ->join('Procesos',        'SubProcesos.IdProceso',        '=', 'Procesos.IdProceso')
                    ->where('Documentos.IdDocumento', $idDocumento)
                    ->get();
    }
}
