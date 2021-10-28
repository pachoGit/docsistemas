<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Archivo extends Controller
{
    public function index()
    {
        return view('archivo');
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
