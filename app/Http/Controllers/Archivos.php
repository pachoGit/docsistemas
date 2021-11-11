<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Archivos extends Controller
{
    public function index()
    {
        return view('archivo');
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
        return 'Esto es para ver los archivos de ' . $idDocumento;
    }

    public function guardar(Request $solicitud)
    {
        $archivo = $solicitud->file('archivo');
        $nombre = $archivo->getClientOriginalName();
        $extension = $archivo->extension();

        $nombre .= date('_d-m-Y_H-i-s');

        $archivo->storeAs('nuevos', $nombre, 'public');

        return view('archivo', ['mensaje' => $nombre . $extension]);
    }
}
