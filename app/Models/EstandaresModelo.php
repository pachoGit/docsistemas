<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'Estandares'
 *
 */
class EstandaresModelo extends Model
{
    protected $table = 'Estandares';

    protected $primaryKey = 'IdEstandar';

    public $timestamps = false;

    /**
     * Obtiene todos los estandares activos
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene un determinado estandar
     *
     * @var $idEstandar - Id del registro
     * @return Collection
     */
    public function retEstandar($idEstandar)
    {
        return $this->where('Estado', 1)
                    ->where('IdEstandar', $idEstandar)
                    ->first();
    }

    /**
     * Obtiene un estandar determinado para ser presentado al usuario final
     *
     * @var $idEstandar - Id del estandar
     * @return Collection
     */
    public function retEstandarUsuario($idEstandar)
    {
        $estandar = $this->retEstandar($idEstandar);
        return collect([
            'IdEstandar'            => $estandar->IdEstandar,
            'NumeroEstandar'        => $estandar->Numero,
            'NombreEstandar'        => $estandar->Nombre,
            'FechaCreacionEstandar' => $estandar->FechaCreacion,
            'EstadoEstandar'        => $estandar->Estado
        ]);
    }

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retEstandarNE($idEstandar)
    {
        return $this->where('IdEstandar', $idEstandar)
                    ->first();
    }

    public function retEstandarUsuarioNE($idEstandar)
    {
        $estandar = $this->retEstandarNE($idEstandar);
        return collect([
            'IdEstandar'            => $estandar->IdEstandar,
            'NumeroEstandar'        => $estandar->Numero,
            'NombreEstandar'        => $estandar->Nombre,
            'FechaCreacionEstandar' => $estandar->FechaCreacion,
            'EstadoEstandar'        => $estandar->Estado
        ]);
    }
}
