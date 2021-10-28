<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DocumentosModelo;

class GrupoDocumentosModelo extends Model
{

    protected $table = 'GrupoDocumentos';

    protected $primaryKey = 'IdGrupoDocumento';
    
    protected $fillable = ['IdSubProceso', 'Nombre', 'Ubicacion',
                           'Descripcion', 'FechaCreacion', 'Estado'];

    public $timestamps = false;

    public function todo()
    {
        return $this->where('Estado', 1)->get();
    }

    /**
     * Obtiene todos los documentos de un determinado grupo de documentos
     *
     * @return Collection
     */
    public function documentos()
    {
        return $this->hasMany(DocumentosModelo::class, $this->primaryKey);
    }
}
