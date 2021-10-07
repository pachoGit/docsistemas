<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'Procesos'
 *
 */
class ProcesosModelo extends Model
{
    protected $table = 'Procesos';

    protected $primaryKey = 'IdProceso';
    
    /**
     * Obtiene todos los datos con 'Estado = 1'
     *
     * @return Collection
     *
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }
    
}
