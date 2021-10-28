<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubProcesosModelo;

/**
 * Modelo para controlar la tabla 'Procesos'
 *
 */
class ProcesosModelo extends Model
{
    protected $table = 'Procesos';

    protected $primaryKey = 'IdProceso';
    
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
     * Obtiene todos los subprocesos de un determinado proceso
     *
     * @return Collection
     */
    public function subProcesos()
    {
        return $this->hasMany(SubProcesosModelo::class, $this->primaryKey);
    }
}
