<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Inicio extends Controller
{
    public function index()
    {
        //return 'Hola Mundo';
        return view('inicio');
    }
}

