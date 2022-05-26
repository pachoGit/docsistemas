@php

$item_inicio = 'active';
$item_proceso_activo = '';
$item_subproceso_activo = '';

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina', 'Inicio - Listado maestro de documentos')

@section('contenido')

    <div class="row">
	<div class="col-lg-3 col-6">                                             
            <!-- small box -->
	    <div class="small-box bg-info">
		<div class="inner">
		    <h3>{{ $ndocumentos }}</h3>
		    <p> Total de documentos activos </p>
		</div>
		<div class="icon">
                    <i class="ion ion-bag"></i>
		</div>
		<a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div> 

	@foreach ($todos as $llave => $valor)
	    {{ $llave }};
	    {{ $valor }};
	@endforeach

    </div>

@endsection()
