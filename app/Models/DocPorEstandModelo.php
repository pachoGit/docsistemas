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
     * Obtiene todos los datos en bruto con 'Estado = 1'
     * de un determinado documento
     *
     * @var $idDocumento - Id del documento
     *
     * @return Collection
     *
     */
    public function todoDe($idDocumento)
    {
        return $this->where('Estado', 1)
                    ->where('IdDocumento', $idDocumento)
                    ->get();
    }

    public function presentarDe($idDocumento)
    {
        return $this->join('Documentos', 'Documentos.IdDocumento', '=', 'DocPorEstand.IdDocumento')
                    ->join('Estandares', 'Estandares.IdEstandar',  '=', 'DocPorEstand.IdEstandar')
                    ->where('DocPorEstand.Estado', 1)
                    ->where('DocPorEstand.IdDocumento', $idDocumento)
                    ->select('Estandares.Nombre as Estandar',
                             'Estandares.Numero as Numero')
                    ->get();
    }
}
