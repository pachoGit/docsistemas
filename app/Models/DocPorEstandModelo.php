<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'DocPorEstand'
 *
 */
class DocPorEstandModelo extends Model
{
    protected $table = 'DocPorEstand';

    protected $primaryKey = 'IdDocPorEstand';

    protected $fillable = ['IdDocumento', 'IdEstandar', 'FechaCreacion', 'Estado'];
        
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
     * Obtiene los estandares de un determinado documento
     *
     * @var $idDocumento - Id del documento
     * @return Collection
     */
    public function retEstandaresDeDocumento($idDocumento)
    {
        return $this->where('Estado', 1)
                    ->where('IdDocumento', $idDocumento)
                    ->get();
    }

    /**
     * Obtiene los documentos de un determinado estandar
     *
     * @var $idDocumento - Id del estandar
     * @return Collection
     */
    public function retDocumentosDeEstandar($idEstandar)
    {
        return $this->where('Estado', 1)
                    ->where('IdEstandar', $idEstandar)
                    ->get();
    }
}
