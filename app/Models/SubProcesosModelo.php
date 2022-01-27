<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
     * Obtiene todos los subprocesos activos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene un subproceso determinado
     *
     * @var $idSubProceso - Id del registro
     * @return Collection
     */
    public function retSubProceso($idSubProceso)
    {
        return $this->where('Estado', 1)
                    ->where('IdSubProceso', $idSubProceso)
                    ->first();
    }

    /**
     * Obtiene los subprocesos de un determinado proceso
     *
     * @var $idProceso - Id del proceso
     * @return Collection
     */
    public function retSubProcesosDeProceso($idProceso)
    {
        return $this->where('Estado', 1)
                    ->where('IdProceso', $idProceso)
                    ->get();
    }

    /**
     * Obtiene el registro listo para ser mostrado al usuario
     *
     * @var $idSubProceso - Id del registro
     * @return Collection
     */
    public function retSubProcesoUsuario($idSubProceso)
    {
        $subProceso = $this->retSubProceso($idSubProceso);
        $moProceso = new ProcesosModelo();
        $proceso = $moProceso->retProcesoUsuario($subProceso->IdProceso);
        
        return collect([
            'IdSubProceso'            => $subProceso->IdSubProceso,
            'NombreSubProceso'        => $subProceso->Nombre,
            'UbicacionSubProceso'     => $subProceso->Ubicacion,
            'FechaCreacionSubProceso' => $subProceso->FechaCreacion,
            'EstadoSubProceso'        => $subProceso->Estado, // Siempre 1
        ])->merge($proceso);
    }

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retSubProcesoNE($idSubProceso)
    {
        return $this->where('IdSubProceso', $idSubProceso)
                    ->first();
    }

    public function retSubProcesosDeProcesoNE($idProceso)
    {
        return $this->where('IdProceso', $idProceso)
                    ->get();
    }

    public function retSubProcesoUsuarioNE($idSubProceso)
    {
        $subProceso = $this->retSubProcesoNE($idSubProceso);
        $moProceso = new ProcesosModelo();
        $proceso = $moProceso->retProcesoNE($subProceso->IdProceso);
        
        return collect([
            'IdSubProceso'            => $subProceso->IdSubProceso,
            'NombreSubProceso'        => $subProceso->Nombre,
            'UbicacionSubProceso'     => $subProceso->Ubicacion,
            'FechaCreacionSubProceso' => $subProceso->FechaCreacion,
            'EstadoSubProceso'        => $subProceso->Estado,
        ])->merge($proceso);
    }
}
