<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\GrupoDocumentosModelo;
use App\Http\Controllers\Util;

class GrupoDocumentos extends Controller
{
    private $moGrupoDocumentos = null;

    public function __construct()
    {
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
    }

    public function crear(Request $solicitud, $idSubProceso)
    {
        $this->validar($solicitud);
        $nombre = $solicitud->input('nombre');
        $descripcion = $solicitud->input('descripcion');
        $ubicacion = $this->generarUbicacion($idSubProceso, $nombre);


        $data = ['IdSubProceso'  => $idSubProceso, 
                 'Nombre'        => $nombre,
                 'Descripcion'   => $descripcion,
                 'Ubicacion'     => $ubicacion,
                 'FechaCreacion' => Util::retFechaCreacion()];

        $this->moGrupoDocumentos->create($data);
        $this->crearCarpeta($ubicacion);
        return redirect()->route('subproceso-versubprocesos', $idSubProceso)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha creado el grupo de documentos correctamente']);
    }

    public function editar(Request $solicitud, $idGrupoDocumento)
    {
        $this->validar($solicitud);
        $nombre = $solicitud->input('nombre');
        $descripcion = $solicitud->input('descripcion');

        $grupo = $this->moGrupoDocumentos->find($idGrupoDocumento);
        $grupo->Nombre = $nombre;
        $grupo->Descripcion = $descripcion;
        $grupo->save();
        return redirect()->route('subproceso-versubprocesos', $grupo->IdSubProceso)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha editado el grupo de documentos correctamente']);
    }

    public function eliminar($idGrupoDocumento)
    {
        return 'Estas en la funcion eliminar';
    }

    private function validar(Request $solicitud)
    {
        return $solicitud->validate([
            'nombre'      => ['required', 'max:255', 'min:3'],
            'descripcion' => ['min:3', 'max:255']
        ]);
    }

    /**
     * Generar la ubicacion de la carpeta de un grupo de documentos
     *
     * @var $idSubProceso - Id del subproceso al que pertenece el nuevo grupo de documentos
     * @var $nombre       - Nombre de la carpeta del nuevo grupo de documentos
     *
     * @return string     - Ruta completa de la nueva carpeta
     */
    private function generarUbicacion($idSubProceso, $nombre)
    {
        $ubicacion = Util::retUbicacionDeSubProceso($idSubProceso);
        $ubicacion .= '/' . Util::eliminarEspacios($nombre);
        return $ubicacion;
    }

    /**
     * Crear una carpeta para un grupo de documentos
     *
     * @var $ruta   - Ruta de la carpeta de un grupo de documentos
     *
     * @return bool
     */
    private function crearCarpeta($ruta)
    {
        // Explicado en el archivo LEEME.md y database/seeders/GrupoDocumentosSeeder.php
        $ruta = str_replace('raiz/', '', $ruta);
        return Storage::makeDirectory($ruta);
    }
}
