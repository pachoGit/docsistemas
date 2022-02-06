<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GrupoDocumentosModelo;
use App\Models\DocumentosModelo;
use App\Http\Controllers\Util;

class GrupoDocumentos extends Controller
{
    private $moGrupoDocumentos = null;

    private $moDocumentos = null;

    public function __construct()
    {
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
    }

    public function crear(Request $solicitud, $idSubProceso)
    {
        $this->validar($solicitud);
        $nombre = $solicitud->input('nombre');
        $descripcion = $solicitud->input('descripcion');
        $ubicacion = $this->generarUbicacion($idSubProceso, $nombre);

        // TODO: Se debe evitar, tambien, ambos nombres sin importar mayusculas y minusculas
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
        $grupo = $this->moGrupoDocumentos->retGrupoDocumento($idGrupoDocumento);

        // TODO: Se debe evitar, tambien, ambos nombres sin importar mayusculas y minusculas
        if ($nombre === 'Todos' || $nombre === 'Otros') // Estos nombres son reservados
            return redirect()->route('subproceso-versubprocesos', $grupo->IdSubProceso)
                             ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'No puede usar este nombre (' . $nombre . '), por favor ingrese otro']);

        $grupo->Nombre = $nombre;
        $grupo->Descripcion = $descripcion;
        $grupo->save();
        return redirect()->route('subproceso-versubprocesos', $grupo->IdSubProceso)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha editado el grupo de documentos correctamente']);
    }

    public function eliminar($idGrupoDocumento)
    {
        $grupo = $this->moGrupoDocumentos->retGrupoDocumento($idGrupoDocumento);
        $documentos = $this->moDocumentos->retDocumentosDeGrupo($idGrupoDocumento);
        foreach ($documentos as $documento)
        {
            $documento->Estado = 0;
            $documento->save();
        }
        $grupo->Estado = 0;
        $grupo->save();
        return redirect()->route('subproceso-versubprocesos', $grupo->IdSubProceso)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha eliminado el grupo de documentos correctamente']);
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
        $ubicacion .= '/' . Util::formatearCadena($nombre);
        $ubicacion .= '-' . Util::retFechaHora();
        return $ubicacion;
    }
}
