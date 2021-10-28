<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\GrupoDocumentosModelo;
use App\Models\ProcesosModelo;

/**
 * Modelo para controlar la tabla 'SubProcesos'
 *
 */
class SubProcesosModelo extends Model
{
    protected $table = 'SubProcesos';

    protected $primaryKey = 'IdSubProceso';
    
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
     * Obtiene todos los grupos de documentos que tiene este subproceso
     *
     * @return Collection
     *
     */
    public function grupoDocumentos()
    {
        return $this->hasMany(GrupoDocumentosModelo::class, $this->primaryKey);
    }
}
