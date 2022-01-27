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
     * Obtiene todos los procesos activos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene el proceso especificado
     *
     * @var $idProceso - Id del registro
     * @return Collection
     */
    public function retProceso($idProceso)
    {
        return $this->where('Estado', 1)
                    ->where('IdProceso', $idProceso)
                    ->first();
    }

    /**
     * Obtiene un proceso para ser presentado al usuario final
     *
     * @return Collection
     */
    public function retProcesoUsuario($idProceso)
    {
        $proceso = $this->retProceso($idProceso);
        return collect([
            'IdProceso'            => $proceso->IdProceso,
            'NombreProceso'        => $proceso->Nombre,
            'UbicacionProceso'     => $proceso->Ubicacion,
            'FechaCreacionProceso' => $proceso->FechaCreacion,
            'EstadoProceso'        => $proceso->Estado
        ]);
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

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retProcesoNE($idProceso)
    {
        return $this->where('IdProceso', $idProceso)
                    ->first();
    }

    public function retProcesoUsuarioNE($idProceso)
    {
        $proceso = $this->retProcesoNE($idProceso);
        return collect([
            'IdProceso'            => $proceso->IdProceso,
            'NombreProceso'        => $proceso->Nombre,
            'UbicacionProceso'     => $proceso->Ubicacion,
            'FechaCreacionProceso' => $proceso->FechaCreacion,
            'EstadoProceso'        => $proceso->Estado
        ]);
    }
}
