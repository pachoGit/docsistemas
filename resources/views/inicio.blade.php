@extends('esqueleto/esqueleto')

@section('titulo-pagina', 'Inicio')

@section('contenido')

    <h1> Página de inicio :) </h1>

    @php
    $procesos = session('procesos');
    
    @endphp

    @foreach ($procesos as $proceso)
	<h3> {{ $proceso->Nombre }}</h3>
    @endforeach

@endsection()
