@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('../esqueleto/esqueleto')

@section('titulo-pagina')
    Grupo de Documentos de {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    <!-- El boton para crear un nuevo grupo de documentos -->
    <div class="row">
        <div class="col-12">
            <div class="card">
		<div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">
			<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#nuevo-grupo">
			    <i class="fa fa-plus"></i> Nuevo Grupo
			</button>
		    </h3>
		</div>
            </div>
        </div>
    </div>
    <!-- Fin del boton -->

    @php
    $tiposTarjeta = ['info', 'success', 'warning', 'danger'];
    $itipo = 0;
    @endphp

    <!-- Las tarjetas con la informacion sobre los grupos de documentos -->
    <div class="row">
    @foreach ($grupos as $grupo)
	@if ($itipo >= count($tiposTarjeta))
	    @php
	    $itipo = 0;
	    @endphp
	@endif
        <div class="col-lg-3 col-6">
	    <x-tarjeta
		titulo="{{ $grupo->Nombre }}"
		descripcion="{{ $grupo->Descripcion }}"
		:tipo="$tiposTarjeta[$itipo++]"
		id-modal="{{ $grupo->IdGrupoDocumento }}"
	    />
	</div>
    @endforeach
    </div>
    <!-- Fin de las tarjetas -->
    
    <!-- Modal para crear un nuevo grupo de documentos -->
    <div class="modal fade" id="nuevo-grupo">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
		<div class="card card-primary">
		    <div class="card-header">
			<h3 class="card-title">Crear nuevo grupo de documentos</h3>
		    </div>
		    <form method="post" action="{{ route('grupo-crear', $subProceso->IdSubProceso) }}">
			@csrf
			@method('post')
			<div class="card-body">
			    <div class="form-group">
				<label for="nombre">Nombre del grupo</label>
				<input type="text" class="form-control" name="nombre" id="nombre" minlength="3" maxlength="255" placeholder="Nombre del nuevo grupo de documentos" required>
			    </div>
			    <div class="form-group">
				<label>Descripción del grupo</label>
				<textarea class="form-control" rows="3" name="descripcion" placeholder="Simple descripción..." minlength="3" maxlength="255"></textarea>
			    </div>
			</div>
			<div class="card-footer">
			    <button type="submit" class="btn btn-primary">Aceptar</button>
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
    <!-- Fin del modal -->

    <!-- Modales de editar -->
    @foreach ($grupos as $grupo)
    <div class="modal fade" id="editar-grupo-{{ $grupo->IdGrupoDocumento }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
		<div class="card card-primary">
		    <div class="card-header">
			<h3 class="card-title">Editar grupo de documentos</h3>
		    </div>
		    <form method="post" action="{{ route('grupo-editar', $grupo->IdGrupoDocumento) }}">
			@csrf
			@method('post')
			<div class="card-body">
			    <div class="form-group">
				<label for="nombre">Nombre del grupo</label>
				<input type="text" class="form-control" name="nombre" id="nombre" minlength="3" maxlength="255" value="{{ $grupo->Nombre }}">
			    </div>
			    <div class="form-group">
				<label>Descripción del grupo (opcional)</label>
				<textarea class="form-control" rows="3" name="descripcion" minlength="3" maxlength="255">{{ $grupo->Descripcion }}</textarea>
			    </div>
			</div>
			<div class="card-footer">
			    <button type="submit" class="btn btn-primary">Editar</button>
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>
    @endforeach
    <!-- Fin del modal -->

    @if (($info = session('Informacion')))
	@if ($info['Estado'] === 'Correcto')
	    <div class="toasts-top-right fixed col-md-6" id="alerta">
		<x-alerta tipo="success" titulo='Éxito'>
		    {{ $info['Mensaje'] }}
		</x-alerta>
	    </div>
	@elseif ($info['Estado'] === 'Error')
	    <div class="toasts-top-right fixed col-md-6" id="alerta">
		<x-alerta tipo="danger" titulo='Error'>
		    {{ $info['Mensaje'] }}
		</x-alerta>
	    </div>
	@endif
    @endif

    <!-- Errores de la funcion validate de la clase Request -->
    @if ($errors->any())
	@foreach ($errors->all() as $error)
	    <div class="toasts-top-right fixed col-md-6" id="alerta">
		<x-alerta tipo="danger" titulo='Error'>
		    {{ $error }}
		</x-alerta>
	    </div>
	@endforeach
    @endif
    <!-- Errores/ -->



@endsection()

@section('css')
    <link rel="stylesheet" href="{{ asset('docsistemas/extra/subproceso/ver_grupo_documentos.css') }}">
@endsection()

@section('js')
    <script src="{{ asset('docsistemas/extra/subproceso/ver_grupo_documentos.js') }}" type="text/javascript"> </script>
@endsection()
