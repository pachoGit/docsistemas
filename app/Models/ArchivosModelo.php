<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'Archivos'
 *
 */
class ArchivosModelo extends Model
{
    protected $table = 'Archivos';

    protected $primaryKey = 'IdArchivo';

    protected $fillable = ['IdDocumento', 'Nombre', 'UbicacionVirtual', 'Version',
                           'FechaCreacion', 'FechaAprovacion', 'FechaModificacion',
                           'MotivoCambio', 'FechaDocumento', 'Estado'];

    public $timestamps = false;

    /**
     * Obtiene todos los datos en bruto con 'Estado = 1'
     *
     * @return Collection
     *
     */
    public function todo()
    {
        return $this->where('Estado', 1)
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
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
                    ->orderBy('FechaCreacion', 'desc')
                    ->get();
    }
}

