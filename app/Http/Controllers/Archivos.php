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
        $documento = $this->moDocumentos->retDocumento($idDocumento);
        $archivos = $this->moArchivos->retArchivosDeDocumento($idDocumento);
        $archivosUsuario = collect([]);
        foreach ($archivos as $archivo)
            $archivosUsuario->push($this->moArchivos->retArchivoUsuario($archivo->IdArchivo));
        $subProceso = $this->moSubProcesos->retSubProceso($archivosUsuario->first()->get('IdSubProceso'));
        $procesoPadre = $this->moProcesos->retProceso($subProceso->IdProceso);

        $data = ['archivos'     => $archivosUsuario,
                 'documento'    => $documento,
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
        $this->validar($solicitud, 1);
        $version = $solicitud->input('version');
        if ($this->existeVersion(intval($version), $idDocumento))
            return redirect()->route('archivos-vcrear', $idDocumento)
                             ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'Ya existe esta versión (' . $version . '), por favor ingrese otro número']);
        $documento = $this->moDocumentos->retDocumento($idDocumento);
        $archivo = $solicitud->file('archivo');
        $nombreArchivo = Util::generarNombreArchivo($archivo, $version);
        
        $data = [
            'IdDocumento'       => $idDocumento,
            'Nombre'            => $nombreArchivo,
            'UbicacionVirtual'  => $documento->UbicacionVirtual . '/' . $nombreArchivo,
            'Version'           => $version,
            'MotivoCambio'      => $solicitud->input('motivo'),
            'FechaCreacion'     => Util::retFechaCreacion(),
            'FechaAprobacion'   => $solicitud->input('fecha-aprobacion'),
            'FechaEmision'      => $solicitud->input('fecha-emision'),
            'ResolucionAprobacion'    => $solicitud->input('resolucion-aprobacion'),
            'ResolucionRectificacion' => $solicitud->input('resolucion-rectificacion'),
            'FechaRectificacion'      => $solicitud->input('fecha-rectificacion'),
            'DocumentoReferencia'     => $solicitud->input('documento-referencia'),
            'Extension'               => $archivo->extension(),
            'FechaModificacion' => Util::retFechaCreacion()
        ];

        if ($solicitud->session()->exists('dni'))
            $data['IdUsuario'] = $solicitud->session()->get('dni');
        else
            return redirect()->route('documentos-todos', $idDocumento)
                    ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'Error en la verificación de usuario. Inicie sesión nuevamente']);

        $this->moArchivos->create($data);
        // Modificamos la informacion del documento
        $documento->Version = $version;
        $documento->FechaAprobacion = $data['FechaAprobacion'];
        $documento->FechaEmision = $data['FechaEmision'];
        $documento->ResolucionAprobacion =    $solicitud->input('resolucion-aprobacion');
        $documento->ResolucionRectificacion = $solicitud->input('resolucion-rectificacion');
        $documento->FechaRectificacion =      $solicitud->input('fecha-rectificacion');
        $documento->DocumentoReferencia =     $solicitud->input('documento-referencia');

        $documento->save();

        $archivo->storeAs($documento->UbicacionVirtual, $nombreArchivo, 'public');
        return redirect()->route('archivos-todos', $idDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha creado una nueva versión del documento correctamente']);
    }

    public function editar(Request $solicitud, $idArchivo)
    {
        $this->validar($solicitud, 2);
        $archivo = $this->moArchivos->retArchivo($idArchivo);
        $documento = $this->moDocumentos->retDocumento($archivo->IdDocumento);
        $version = $solicitud->input('version');

        if ($archivo->Version !== intval($version)) // Modifico el numero de version
            if ($this->existeVersion(intval($version), $documento->IdDocumento))
                return redirect()->route('archivos-veditar', $archivo->IdArchivo)
                                 ->with('Informacion', ['Estado' => 'Error', 'Mensaje' => 'Ya existe esta versión (' . $version . '), por favor ingrese otro número']);

        $ubicacion = $archivo->UbicacionVirtual;

        if ($solicitud->file('archivo') !== null)
        {
            $nombreArchivo = Util::generarNombreArchivo($archivo, $version);
            $ubicacion = $documento->UbicacionVirtual . '/' . $nombreArchivo;
            $archivo->storeAs($documento->UbicacionVirtual, $nombreArchivo, 'public');
        }
        
        $fechaAprobacion = $solicitud->input('fecha-aprobacion');
        $fechaEmision = $solicitud->input('fecha-emision');

        // Si la version que se esta editando es la version actual, modificar la informacion
        // del documento
        if ($documento->Version === intval($version))
        {
            $documento->Version = $version;
            $documento->FechaAprobacion = $fechaAprobacion;
            $documento->FechaEmision = $fechaEmision;

            $documento->ResolucionAprobacion =    $solicitud->input('resolucion-aprobacion');
            $documento->ResolucionRectificacion = $solicitud->input('resolucion-rectificacion');
            $documento->FechaRectificacion =      $solicitud->input('fecha-rectificacion');
            $documento->DocumentoReferencia =     $solicitud->input('documento-referencia');

            $documento->save();
        }

        $archivo->Version = $version;
        $archivo->FechaAprobacion = $fechaAprobacion;
        $archivo->FechaEmision = $fechaEmision;
        $archivo->MotivoCambio = $solicitud->input('motivo');

        $archivo->ResolucionAprobacion =    $solicitud->input('resolucion-aprobacion');
        $archivo->ResolucionRectificacion = $solicitud->input('resolucion-rectificacion');
        $archivo->FechaRectificacion =      $solicitud->input('fecha-rectificacion');
        $archivo->DocumentoReferencia =     $solicitud->input('documento-referencia');

        $archivo->save();

        return redirect()->route('archivos-todos', $documento->IdDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha editado la versión correctamente']);
    }

    public function eliminar($idArchivo)
    {
        $archivo = $this->moArchivos->retArchivo($idArchivo);
        $ubicacion = $archivo->UbicacionVirtual;
        // No validamos ya que si no existe el archivo, no pasa nada
        // aun asi cambiamos de estado al registro)
        Storage::disk('public')->delete($ubicacion);
        $archivo->Estado = 0;
        $archivo->save();
        // Si se esta eliminando la version actual tenemos que modificar al documento
        $documento = $this->moDocumentos->retDocumento($archivo->IdDocumento);
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
                $documento->FechaAprobacion = null;
                $documento->FechaEmision = null;
            }
            else
            {
                $actual = $archivos->first();
                $documento->Version = $actual->Version;
                $documento->FechaAprobacion = $actual->FechaAprobacion;
                $documento->FechaEmision = $actual->FechaEmision;

                $documento->ResolucionAprobacion = $actual->ResolucionAprobacion;
                $documento->ResolucionRectificacion = $actual->ResolucionRectificacion;
                $documento->FechaRectificacion = $actual->FechaRectificacion;
                $documento->DocumentoReferencia = $actual->DocumentoRefencia;
            };
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
        $archivo = $this->moArchivos->retArchivo($idArchivo);
        $ubicacion = $archivo->UbicacionVirtual;
        return response()->download(public_path('raiz/' . $ubicacion));
    }

    /**
     * Convertir a un archivo a la version actual del documento
     *
     * @var $idArchivo - Id del archivo
     *
     * @return Redirect
     */
    public function hacerActual($idArchivo)
    {
        $archivo = $this->moArchivos->find($idArchivo);
        $documento = $this->moDocumentos->find($archivo->IdDocumento);
        $documento->Version = $archivo->Version;
        $documento->FechaAprobacion = $archivo->FechaAprobacion;
        $documento->FechaEmision = $archivo->FechaEmision;

        $documento->ResolucionAprobacion =    $archivo->ResolucionAprobacion;
        $documento->ResolucionRectificacion = $archivo->ResolucionRectificacion;
        $documento->FechaRectificacion =      $archivo->FechaRectificacion;
        $documento->DocumentoReferencia =     $archivo->DocumentoReferencia;

        $documento->save();
        return redirect()->route('archivos-todos', $archivo->IdDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha cambiado la versión correctamente']);
    }

    /**
     * Redirige hacia la vista para crear un nueva version
     *
     * @var $idDocumento - Id del documento
     * @return view
     */
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

    /**
     * Redirige hacia la vista para editar una version
     *
     * @var $idDocumento - Id del documento
     * @return view
     */
    public function vistaEditar($idArchivo)
    {
        $archivo = $this->moArchivos->retArchivoUsuario($idArchivo);
        $subProceso = $this->moSubProcesos->find($archivo->get('IdSubProceso'));
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        
        $data = ['archivo'      => $archivo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre];

        return view('archivos/editar', $data);
    }

    /**
     * Valida la solicitud del usuario
     *
     * @var Request $solicitud - Solicitud Http entrante
     * @var int tfuncion - 1 o 2 para la funcion crear o editar
     */
    private function validar(Request $solicitud, int $tfuncion)
    {
        // Campos que validan la funcion crear y editar por igual
        $comun = [
            'version'          => ['required', 'numeric'],
            'motivo'           => ['max:510'],
            'fecha-aprobacion' => ['date'],
            'fecha-emision'    => ['required', 'date']
        ];

        if ($tfuncion === 1) // Se llamo desde la funcion crear
            $comun['archivo'] = ['required'];
        return $solicitud->validate($comun);
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
        $archivos = $this->moArchivos->retArchivosDeDocumento($idDocumento);
        foreach ($archivos as $archivo)
            if ($archivo->Version === $version)
                return true;
        return false;
    }
}
