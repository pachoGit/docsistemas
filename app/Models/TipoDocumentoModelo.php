<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para controlar la tabla 'TipoDocumento'
 *
 */
class TipoDocumentoModelo extends Model
{
    protected $table = 'TipoDocumento';

    protected $primaryKey = 'IdTipoDocumento';

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

}

