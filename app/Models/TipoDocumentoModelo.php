<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'TipoDocumento'
 *
 */
class TipoDocumentoModelo extends Model
{
    protected $table = 'TipoDocumento';

    protected $primaryKey = 'IdTipoDocumento';

    public $timestamps = false;
    
    /**
     * Obtiene todos los tipos de documentos activos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene un tipo de documento determinado
     *
     * @var $idTipoDocumento - Id del tipo de documento
     * @return Collection
     */
    public function retTipoDocumento($idTipoDocumento)
    {
        return $this->where('Estado', 1)
                    ->where('IdTipoDocumento', $idTipoDocumento)
                    ->first();
    }

    /**
     * Obtiene una unidad para ser presentado al usuario final
     *
     * @return Collection
     */
    public function retTipoDocumentoUsuario($idTipoDocumento)
    {
        $tipo = $this->retTipoDocumento($idTipoDocumento);
        return collect([
            'IdTipoDocumento'            => $tipo->IdTipoDocumento,
            'NombreTipoDocumento'        => $tipo->Nombre,
            'DescripcionTipoDocumento'   => $tipo->Descripcion,
            'FechaCreacionTipoDocumento' => $tipo->FechaCreacion,
            'EstadoTipoDocumento'        => $tipo->Estado
        ]);
    }

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retTipoDocumentoNE($idTipoDocumento)
    {
        return $this->where('IdTipoDocumento', $idTipoDocumento)
                    ->first();
    }

    public function retTipoDocumentoUsuarioNE($idTipoDocumento)
    {
        $tipo = $this->retTipoDocumentoNE($idTipoDocumento);
        return collect([
            'IdTipoDocumento'            => $tipo->IdTipoDocumento,
            'NombreTipoDocumento'        => $tipo->Nombre,
            'DescripcionTipoDocumento'   => $tipo->Descripcion,
            'FechaCreacionTipoDocumento' => $tipo->FechaCreacion,
            'EstadoTipoDocumento'        => $tipo->Estado
        ]);
    }
}

