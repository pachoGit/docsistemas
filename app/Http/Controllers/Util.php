<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

use App\Models\SubProcesosModelo;
use App\Models\GrupoDocumentosModelo;

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
     * Obtiene la ruta de un determinado grupo de documentos
     *
     * @var int $idGrupoDocumento - Id de un grupo de documentos
     *
     * @return string - La ubicacion en el sistema de archivos del grupo de documento
     */
    public static function retUbicacionDeGrupoDocumento($idGrupoDocumento)
    {
        $moGrupoDocumentos = new GrupoDocumentosModelo();
        $grupo = $moGrupoDocumentos->find($idGrupoDocumento);
        return $grupo->Ubicacion;
    }

    /**
     * Elimina los espacios en blanco y reemplazar por '-' de cualquier cadena
     *
     * @var string $cadena - Una cadena de caracteres
     *
     * @return string - La cadena sin espacios en blanco
     *
     */
    public static function eliminarEspacios($cadena)
    {
        return str_replace(' ', '-', $cadena);
    }

    /**
     * Obtener la fecha actual
     *
     * @return string - La fecha de hoy
     *
     */
    public static function retFechaCreacion()
    {
        return date('Y-m-d');
    }

    /**
     * Obtener la fecha y hora actual
     *
     * @return string - La fecha y hora de hoy
     *
     */
    public static function retFechaHora()
    {
        return date('Y-m-d_H-i-s');
    }

    /**
     * Crea una nueva carpeta ($RUTA_PROYECTO/public es la ruta base)
     *
     * @var string $ruta - Ruta de la nueva carpeta
     *
     * @return bool - true en case de exito y false en caso contrario
     *
     */
    public static function crearCarpeta($ruta)
    {
        return (!is_dir($ruta) ? mkdir($ruta, 0777, true) : false);
    }

    /**
     * Genera el nombre del archivo
     * Ejemplo: Entra - "Documento de informe de egresados.pdf"
     *          Sale  - "Documento-de-informe-de-egresados:2021-11-04_22-28-30-v1.pdf"
     *
     * @var object UploadedFile $archivo  - El archivo que subio el usuario
     * @var string              $version  - Version del archivo
     *
     * @return string - Nombre generado 
     *
     */
    public static function generarNombreArchivo(UploadedFile $archivo, $version)
    {
        $nombre = $archivo->getClientOriginalName();
        $nombre = Util::eliminarEspacios($nombre);
        // Eliminamos la extension del archivo para renombrar el archivo
        $nombre = substr($nombre, 0, strrpos($nombre, $archivo->extension()) - 1);
        $nombre .= ':' . Util::retFechaHora() . '-v' . $version . '.' . $archivo->extension();
        return $nombre;
    }
}
