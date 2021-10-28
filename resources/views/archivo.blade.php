@extends('esqueleto/esqueleto')

@section('titulo-pagina', 'Archivos')

@section('contenido')

    <h1> Página de subida de archivos :) </h1>
    
    <form action="{{ route('archivo-guardar') }}" method="post" enctype="multipart/form-data">
	 @csrf
	<input name="archivo" type="file" accept="application/pdf" value=""/>
	<input name="enviarArchivo" type="submit" value="Enviar"/>
	<input name="_token" type="hidden" value="{{ csrf_token() }}"/>
    </form>

    @isset($mensaje)
    <p>{{ $mensaje }}</p>
    @endisset

@endsection()
