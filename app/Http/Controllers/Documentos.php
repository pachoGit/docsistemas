<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\GrupoDocumentosModelo;
use App\Models\DocumentosModelo;
use App\Models\ProcesosModelo;
use App\Models\SubProcesosModelo;
use App\Models\TipoDocumentoModelo;
use App\Models\UnidadesModelo;
use App\Models\EstandaresModelo;
use App\Models\DocPorEstandModelo;
use App\Models\ArchivosModelo;

use App\Http\Controllers\Util;

class Documentos extends Controller
{
    private $moGrupoDocumentos = null;

    private $moDocumentos = null;

    private $moProcesos = null;

    private $moSubProcesos = null;

    private $moTipoDocumento = null;

    private $moUnidades = null;

    private $moEstandares = null;

    private $moDocPorEstand = null;

    private $moArchivos = null;

    public function __construct()
    {
        $this->moGrupoDocumentos = new GrupoDocumentosModelo();
        $this->moDocumentos = new DocumentosModelo();
        $this->moProcesos = new ProcesosModelo();
        $this->moSubProcesos = new SubProcesosModelo();
        $this->moTipoDocumento = new TipoDocumentoModelo();
        $this->moUnidades = new UnidadesModelo();
        $this->moEstandares = new EstandaresModelo();
        $this->moDocPorEstand = new DocPorEstandModelo();
        $this->moArchivos = new ArchivosModelo();
    }

    /**
     * Ver los Documentos de un determinado Grupo de Documentos
     *
     * @param $idGrupoDocumento - El ID del grupo de documento
     *
     * @return view
     *
     */
    public function todos($idGrupoDocumento)
    {
        $documentos = $this->moDocumentos->presentarTodos($idGrupoDocumento);
        $grupo = $this->moGrupoDocumentos->find($idGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);

        $data = ['documentos'   => $documentos,
                 'grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre];

        return view('documentos/todos', $data);
    }

    public function ver($idDocumento)
    {
        $documento = $this->moDocumentos->presentarDe($idDocumento)->first();
        $estandares = $this->moDocPorEstand->presentarDe($idDocumento);
        $grupo = $this->moGrupoDocumentos->find($documento->IdGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);

        $data = ['documento'    => $documento,
                 'estandares'   => $estandares,
                 'grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre];

        return view('documentos/ver', $data);
    }

    /**
     * Crear un nuevo documento - Tambien se crea un nuevo 'Archivo'
     *
     * @var $solicitud        - Solicitud entrante
     * @var $idGrupoDocumento - Id del grupo de documento del nuevo documento
     *
     * @return view
     */
    public function crear(Request $solicitud, $idGrupoDocumento)
    {
        $this->validar($solicitud);
        $ubicacion = $this->generarUbicacion($idGrupoDocumento, $solicitud->input('nombre'));

        /* Creacion del 'Documento' */
        $data = [
            'IdGrupoDocumento' => $idGrupoDocumento,
            'IdTipoDocumento'  => $solicitud->input('tipo'),
            'IdUnidad'         => $solicitud->input('unidad'),
            'Codigo'           => $solicitud->input('codigo'),
            'Nombre'           => $solicitud->input('nombre'),
            'UbicacionVirtual' => $ubicacion,
            'UbicacionFisica'  => $solicitud->input('ubicacion-fisica'),
            'Version'          => $solicitud->input('version'),
            'FechaAprovacion'  => $solicitud->input('fecha-aprovacion'),
            'FechaCreacion'    => Util::retFechaCreacion()
        ];
        $documento = $this->moDocumentos->create($data);
        foreach ($solicitud->input('estandares') as $estandar)
        {
            $data = [
                'IdDocumento' => $documento->IdDocumento,
                'IdEstandar'  => $estandar
            ];
            $this->moDocPorEstand->create($data);
        }
        Util::crearCarpeta($ubicacion);

        /* Creacion del 'Archivo' */
        $archivo = $solicitud->file('archivo');
        $nombreArchivo = Util::generarNombreArchivo($archivo, $documento->Version);

        $data = [
            'IdDocumento'       => $documento->IdDocumento,
            'Nombre'            => $nombreArchivo,
            'UbicacionVirtual'  => $documento->UbicacionVirtual . '/' . $nombreArchivo,
            'Version'           => $documento->Version,
            'FechaCreacion'     => Util::retFechaCreacion(),
            'FechaAprovacion'   => $documento->FechaAprovacion,
            'FechaModificacion' => Util::retFechaCreacion()
        ];

        // Guardamos el archivo fisico en el sistema de archivos
        // Ubicacion esta asi: public/raiz/Estrategicos/ProgramaEgresados/Matrices
        // Lo cambiamos asi:   Estrategicos/ProgramaEgresados/Matrices
        $archivo->storeAs(str_replace('public/raiz/', '', $documento->UbicacionVirtual), $nombreArchivo, 'public');
        $this->moArchivos->create($data);
        
        return redirect()->route('documentos-todos', $idGrupoDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha creado el documento correctamente']);
        
    }

    public function editar($idDocumento)
    {
        
    }

    public function eliminar(Request $solicitud, $idDocumento)
    {
        $motivo = $solicitud->input('motivo');
        // TODO: Guardar el motivo
        $documento = $this->moDocumentos->find($idDocumento);
        $documento->Estado = 0;
        //$documento->MotivoEliminado = $motivo;
        $documento->save();

        return redirect()->route('documentos-todos', $documento->IdGrupoDocumento)
                         ->with('Informacion', ['Estado' => 'Correcto', 'Mensaje' => 'Se ha eliminado el documento correctamente']);
    }

    public function vistaCrear($idGrupoDocumento)
    {
        $grupo = $this->moGrupoDocumentos->find($idGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        $tipoDocumento = $this->moTipoDocumento->todo();
        $unidades = $this->moUnidades->todo();
        $estandares = $this->moEstandares->todo();

        $data = ['grupo'        => $grupo,
                 'subProceso'   => $subProceso,
                 'procesoPadre' => $procesoPadre,
                 'tipos'        => $tipoDocumento,
                 'unidades'     => $unidades,
                 'estandares'   => $estandares];

        return view('documentos/crear', $data);
    }

    public function vistaEditar($idDocumento)
    {
        $documento = $this->moDocumentos->find($idDocumento);
        $grupo = $this->moGrupoDocumentos->find($documento->IdGrupoDocumento);
        $subProceso = $this->moSubProcesos->find($grupo->IdSubProceso);
        $procesoPadre = $this->moProcesos->find($subProceso->IdProceso);
        $tipoDocumento = $this->moTipoDocumento->todo();
        $unidades = $this->moUnidades->todo();
        $estandares = $this->moEstandares->todo();
        $docEstandares = $this->moDocPorEstand->presentarDe($idDocumento);

        //return var_dump($docEstandares->toArray());

        $data = ['grupo'         => $grupo,
                 'subProceso'    => $subProceso,
                 'procesoPadre'  => $procesoPadre,
                 'tipos'         => $tipoDocumento,
                 'unidades'      => $unidades,
                 'estandares'    => $estandares,
                 'documento'     => $documento,
                 'docEstandares' => $docEstandares];

        return view('documentos/editar', $data);
    }


    private function validar(Request $solicitud)
    {
        return $solicitud->validate([
            'codigo'           => ['required', 'max:255', 'min:1'],
            'nombre'           => ['required', 'max:255', 'min:3'],
            'tipo'             => ['required'],
            'unidad'           => ['required'],
            'ubicacion-fisica' => ['max:255', 'min:3'],
            'fecha-aprovacion' => ['date'],
            'archivo'          => ['required']
        ]);
    }
    
    private function generarUbicacion($idGrupoDocumento, $nombre)
    {
        $ubicacion = Util::retUbicacionDeGrupoDocumento($idGrupoDocumento);
        $ubicacion .= '/' . Util::eliminarEspacios($nombre);
        if (!is_dir($ubicacion))
            return $ubicacion;
        // Si la ubicacion (la carpeta) ya existe, agregamos la fecha y hora de
        // creacion al nombre de la carpeta
        $ubicacion .= '-' . Util::retFechaHora();
        return $ubicacion;
    }
}
