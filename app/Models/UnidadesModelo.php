<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'Unidades'
 *
 */
class UnidadesModelo extends Model
{
    protected $table = 'Unidades';

    protected $primaryKey = 'IdUnidad';

    public $timestamps = false;
    
    /**
     * Obtiene todas las unidades
     *
     * @return Collection
     */
    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene una unidad determinada
     *
     * @var $idUnidad - Id del registro
     * @return Collection
     */
    public function retUnidad($idUnidad)
    {
        return $this->where('Estado', 1)
                    ->where('IdUnidad', $idUnidad)
                    ->first();
    }

    /**
     * Obtiene una unidad para ser presentado al usuario final
     *
     * @return Collection
     */
    public function retUnidadUsuario($idUnidad)
    {
        $unidad = $this->retUnidad($idUnidad);
        return collect([
            'IdUnidad'            => $unidad->IdUnidad,
            'NombreUnidad'        => $unidad->Nombre,
            'FechaCreacionUnidad' => $unidad->FechaCreacion,
            'EstadoUnidad'        => $unidad->Estado
        ]);
    }

    /*********************************************************************
     * FUNCIONES QUE INCLUYEN REGISTROS DESHABILITADOS
     ********************************************************************/

    public function todoNE()
    {
        return $this->get();
    }

    public function retUnidadNE($idUnidad)
    {
        return $this->where('IdUnidad', $idUnidad)
                    ->first();
    }

    public function retUnidadUsuarioNE($idUnidad)
    {
        $unidad = $this->retUnidadNE($idUnidad);
        return collect([
            'IdUnidad'            => $unidad->IdUnidad,
            'NombreUnidad'        => $unidad->Nombre,
            'FechaCreacionUnidad' => $unidad->FechaCreacion,
            'EstadoUnidad'        => $unidad->Estado
        ]);
    }
}
