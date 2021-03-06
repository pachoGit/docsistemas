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
     * Elimina caracteres raros que podrian generar errores en nombres
     * de carpetas y archivos
     *
     * @var string $cadena - Una cadena de caracteres
     *
     * @return string - La cadena sin caracteres raros
     *
     */
    public static function formatearCadena($cadena)
    {
        $eliminar = [':', '{', '}', ';', '+', '*', '/', '\\', '?', '¡', '!', '&', '%', '$',
                     '#', '=', '^', '`', '"', '~', '<',  '>', '[', ']', '(', ')', '|', ' '];
        
        return str_replace($eliminar, '', $cadena);
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
        return date('Y-m-d-H-i-s');
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
        $ruta = public_path('raiz/' . $ruta);
        return (!is_dir($ruta) ? mkdir($ruta, 0777, true) : false);
    }

    /**
     * Genera el nombre del archivo
     * Ejemplo: Entra - "Documento de informe de egresados.pdf"
     *          Sale  - "Documento-de-informe-de-egresados_2021-11-04-22-28-30-v1.pdf"
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
        $nombre = Util::formatearCadena($nombre);
        // Eliminamos la extension del archivo para renombrar el archivo
        $nombre = substr($nombre, 0, strrpos($nombre, $archivo->extension()) - 1);
        $nombre .= '_' . Util::retFechaHora() . '-v' . $version . '.' . $archivo->extension();
        return $nombre;
    }
}
