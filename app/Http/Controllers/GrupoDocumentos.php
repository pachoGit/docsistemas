<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        if ($nombre === 'Todos' || $nombre === 'Otros') // Estos nombres son reservados
        return redirect()->route('subproceso-versubprocesos', $idSubProceso)
                         ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'No puede usar este nombre (' . $nombre . '), por favor ingrese otro']);

        $data = ['IdSubProceso'  => $idSubProceso, 
                 'Nombre'        => $nombre,
                 'Descripcion'   => $descripcion,
                 'Ubicacion'     => $ubicacion,
                 'FechaCreacion' => Util::retFechaCreacion()];

        // TODO: Gestionar errores
        Util::crearCarpeta($ubicacion);
        $this->moGrupoDocumentos->create($data);
        return redirect()->route('subproceso-versubprocesos', $idSubProceso)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha creado el grupo de documentos correctamente']);
    }

    public function editar(Request $solicitud, $idGrupoDocumento)
    {
        $this->validar($solicitud);
        $nombre = $solicitud->input('nombre');
        $descripcion = $solicitud->input('descripcion');

        if ($nombre === 'Todos' || $nombre === 'Otros') // Estos nombres son reservados
            return redirect()->route('subproceso-versubprocesos', $idSubProceso)
                             ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'No puede usar este nombre (' . $nombre . '), por favor ingrese otro']);

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
        if (!is_dir($ubicacion))
            return $ubicacion;
        // Si la ubicacion (la carpeta) ya existe, agregamos la fecha y hora de
        // creacion al nombre de la carpeta
        $ubicacion .= '-' . Util::retFechaHora();
        return $ubicacion;
    }
}
