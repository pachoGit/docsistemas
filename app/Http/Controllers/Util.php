<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubProcesosModelo;

/**
 * Clases que son de utilidad para realizar determinadas acciones
 *
 */
class Util extends Controller
{
    /**
     * Obtiene la ruta de un determinado subproceso
     *
     * @var int $idSubProceso - Id de un subproceso
     *
     * @return string - La ubicacion en el sistema de archivos del subproceso
     */
    public static function retUbicacionDeSubProceso($idSubProceso)
    {
        $moSubProcesos = new SubProcesosModelo();
        $subProceso = $moSubProcesos->find($idSubProceso);
        return $subProceso->Ubicacion;
    }

    /**
     * Elimina los espacios en blanco de cualquier cadena
     *
     * @var string $cadena - Una cadena de caracteres
     *
     * @return string - La cadena sin espacios en blanco
     *
     */
    public static function eliminarEspacios($cadena)
    {
        return str_replace(' ', '', $cadena);
    }

    public static function retFechaCreacion()
    {
        return date('Y-m-d');
    }
}
