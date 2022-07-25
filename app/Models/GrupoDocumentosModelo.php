<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubProcesosModelo;

class GrupoDocumentosModelo extends Model
{

    protected $table = 'GrupoDocumentos';

    protected $primaryKey = 'IdGrupoDocumento';
    
    protected $fillable = ['IdSubProceso', 'Nombre', 'Ubicacion',
                           'Descripcion', 'FechaCreacion', 'IdUsuario', 'Estado'];

    public $timestamps = false;

    /**
     * Obtiene todos los grupos de documentos activos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene un grupo de documento determinado
     *
     * @var $idGrupoDocumento - Id del registro
     * @return Collection
     */
    public function retGrupoDocumento($idGrupoDocumento)
    {
        return $this->where('Estado', 1)
                    ->where('IdGrupoDocumento', $idGrupoDocumento)
                    ->first();
    }
    
    /**
     * Obtiene los grupos de documentos de un determinado sub proceso
     *
     * @var $idSubProceso - Id del sub proceso
     * @return Collection
     */
    public function retGrupoDocumentosDeSubProceso($idSubProceso)
    {
        return $this->where('Estado', 1)
                    ->where('IdSubProceso', $idSubProceso)
                    ->get();
    }

    /**
     * Obtiene el registro listo para ser mostrado al usuario
     *
     * @var $idGrupoDocumento - Id del grupo de documento
     * @return Collection
     */
    public function retGrupoDocumentoUsuario($idGrupoDocumento)
    {
        $grupo = $this->retGrupoDocumento($idGrupoDocumento);
        $moSubProceso = new SubProcesosModelo();
        $subProceso = $moSubProceso->retSubProcesoUsuario($grupo->IdSubProceso);

        return collect([
            'IdGrupoDocumento'            => $grupo->IdGrupoDocumento,
            'NombreGrupoDocumento'        => $grupo->Nombre,
            'DescripcionGrupoDocumento'   => $grupo->Descripcion,
            'UbicacionGrupoDocumento'     => $grupo->Ubicacion,
            'FechaCreacionGrupoDocumento' => $grupo->FechaCreacion,
            'EstadoGrupoDocumento'        => $grupo->Estado,
        ])->merge($subProceso);
    }

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retGrupoDocumentoNE($idGrupoDocumento)
    {
        return $this->where('IdGrupoDocumento', $idGrupoDocumento)
                    ->first();
    }

    public function retGrupoDocumentosDeSubProcesoNE($idProceso)
    {
        return $this->where('IdProceso', $idProceso)
                    ->get();
    }

    public function retGrupoDocumentoUsuarioNE($idGrupoDocumento)
    {
        $grupo = $this->retGrupoDocumentoNE($idGrupoDocumento);
        $moSubProceso = new SubProcesosModelo();
        $subProceso = $moSubProceso->retSubProcesoNE($grupo->IdSubProceso);

        return collect([
            'IdGrupoDocumento'            => $grupo->IdGrupoDocumento,
            'NombreGrupoDocumento'        => $grupo->Nombre,
            'DescripcionGrupoDocumento'   => $grupo->Descripcion,
            'UbicacionGrupoDocumento'     => $grupo->Ubicacion,
            'FechaCreacionGrupoDocumento' => $grupo->FechaCreacion,
            'EstadoGrupoDocumento'        => $grupo->Estado,
            'IdSubProceso'                => $subProceso->IdSubProceso,
            'IdProceso'                   => $subProceso->IdProceso,
            'NombreSubProceso'            => $subProceso->Nombre,
            'UbicacionSubProceso'         => $subProceso->Ubicacion,
            'FechaCreacionSubProceso'     => $subProceso->FechaCreacion,
            'EstadoSubProceso'            => $subProceso->Estado
        ]);
    }
}
