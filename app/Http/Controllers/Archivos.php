<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\ArchivosModelo;
use App\Models\GrupoDocumentosModelo;
use App\Models\DocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;

use App\Http\Controllers\Util;

class Archivos extends Controller
{
    private $moArchivos = null;

    private $moGrupoDocumentos = null;

    private $moDocumentos = null;

    private $moProcesos = null;

    private $moSubProcesos = null;

    public function __construct()
    {
        $this->moArchivos = new ArchivosModelo();
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moSubProcesos = new SubProcesosModelo();
    }

    /**
     * Mostrar todos los archivos con 'Estado = 1'
     *
     * @var $idDocumento - Id del documento
     *
     * @return view
     *
     */
    public function todos($idDocumento)
    {
        $archivos = $this->moArchivos->todoDe($idDocumento);
        $documento = $this->moDocumentos->find($idDocumento);
        $grupo = $this->moGrupoDocumentos->find($documento->IdGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);

        $data = ['archivos'     => $archivos,
                 'documento'    => $documento,
                 'grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre];

        return view('archivos/todos', $data);
    }

    /**
     * Crear un nuevo 'Archivo' (Una nueva version de un 'Documento')
     *
     * @var $solicitud        - Solicitud entrante
     * @var $idDocumento      - Id del documento
     *
     * @return view
     */
    public function crear(Request $solicitud, $idDocumento)
    {
        $this->validar($solicitud);
        $version = $solicitud->input('version');
        if ($this->existeVersion(intval($version), $idDocumento))
            return redirect()->route('archivos-vcrear', $idDocumento)
                             ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'Ya existe esta versión (' . $version . '), por favor ingrese otro número']);
        $documento = $this->moDocumentos->find($idDocumento);
        $archivo = $solicitud->file('archivo');
        $nombreArchivo = Util::generarNombreArchivo($archivo, $version);
        
        $data = [
            'IdDocumento'       => $idDocumento,
            'Nombre'            => $nombreArchivo,
            'UbicacionVirtual'  => $documento->UbicacionVirtual . '/' . $nombreArchivo,
            'Version'           => $version,
            'MotivoCambio'      => $solicitud->input('motivo'),
            'FechaCreacion'     => Util::retFechaCreacion(),
            'FechaAprovacion'   => $solicitud->input('fecha-aprovacion'),
            'FechaDocumento'    => $solicitud->input('fecha-documento'),
            'FechaModificacion' => Util::retFechaCreacion()
        ];
        $this->moArchivos->create($data);
        // Modificamos la informacion del documento
        $documento->Version = $version;
        $documento->FechaAprovacion = $data['FechaAprovacion'];
        $documento->FechaDocumento = $data['FechaDocumento'];
        $documento->save();

        $archivo->storeAs(str_replace('public/raiz/', '', $documento->UbicacionVirtual), $nombreArchivo, 'public');
        return redirect()->route('archivos-todos', $idDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha creado una nueva version del documento correctamente']);
    }

    public function eliminar($idArchivo)
    {
        $archivo = $this->moArchivos->find($idArchivo);
        $ubicacion = str_replace('public/raiz', '', $archivo->UbicacionVirtual);
        // No validamos ya que si no existe el archivo, no pasa nada
        // aun asi cambiamos de estado al registro
        Storage::disk('public')->delete($ubicacion);
        $archivo->Estado = 0;
        $archivo->save();
        // Si se esta eliminando la version actual tenemos que modificar al documento
        $documento = $this->moDocumentos->find($archivo->IdDocumento);
        if ($documento->Version == $archivo->Version)
        {
            // Obtenemos la version mas alta hasta el momento
            $archivos = $this->moArchivos->where('Estado', 1)
                                         ->where('IdDocumento', $documento->IdDocumento)
                                         ->orderBy('Version', 'desc')
                                         ->get();
            if ($archivos->count() <= 0)
            {
                // El documento no tiene ninguna version
                $documento->Version = 0;
                $documento->FechaAprovacion = null;
                $documento->FechaDocumento = null;
            }
            else
            {
                $actual = $archivos->first();
                $documento->Version = $actual->Version;
                $documento->FechaAprovacion = $actual->FechaAprovacion;
                $documento->FechaDocumento = $actual->FechaDocumento;
            }
        }
        $documento->save();
        return redirect()->route('archivos-todos', $archivo->IdDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha eliminado la versión correctamente']);
    }

    /**
     * Descargar un archivo
     *
     * @var $idArchivo - Id del archivo a descargar
     *
     * @return Response
     */
    public function descargar($idArchivo)
    {
        $archivo = $this->moArchivos->find($idArchivo);
        $ubicacion = $archivo->UbicacionVirtual;
        return response()->download(public_path(str_replace('public', '', $ubicacion)));
    }

    /**
     * Convertir a un archivo a la version actual del documento
     *
     * @var $idArchivo - Id del archivo a descargar
     *
     * @return Response
     */
    public function hacerActual($idArchivo)
    {
        $archivo = $this->moArchivos->find($idArchivo);
        $documento = $this->moDocumentos->find($archivo->IdDocumento);
        $documento->Version = $archivo->Version;
        $documento->FechaAprovacion = $archivo->FechaAprovacion;
        $documento->FechaDocumento = $archivo->FechaDocumento;
        $documento->save();
        return redirect()->route('archivos-todos', $archivo->IdDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha cambiado la versión correctamente']);
    }

    public function vistaCrear($idDocumento)
    {
        $documento = $this->moDocumentos->find($idDocumento);
        $grupo = $this->moGrupoDocumentos->find($documento->IdGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        
        $data = ['grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'documento'    => $documento];

        return view('archivos/crear', $data);
    }



    private function validar(Request $solicitud)
    {
        return $solicitud->validate([
            'version'          => ['required', 'numeric'],
            'motivo'           => ['max:510'],
            'fecha-aprovacion' => ['date'],
            'fecha-documento'  => ['date'],
            'archivo'          => ['required']
        ]);
    }

    /**
     * Informa si existe la version de este documento
     *
     * @var int $version - La version a verificar
     *
     * @return bool 
     */
    private function existeVersion($version, $idDocumento)
    {
        $archivos = $this->moArchivos->todoDe($idDocumento);
        foreach ($archivos as $archivo)
            if ($archivo->Version === $version)
                return true;
        return false;
    }
}
