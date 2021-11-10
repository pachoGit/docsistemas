@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Documento de  {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    <div class="card card-primary">
	<div class="card-header">
            <h3 class="card-title">Agrupado en: {{ $grupo->Nombre }}</h3>
	    @if ($documento->Estado === 1)
		<div class="card-tools">
		    <span class="badge badge-success" title="Este documento esta activo">Activo</span>
		</div>
	    @else
		<div class="card-tools">
		    <span class="badge badge-danger" title="Este documento ha sido eliminado">Eliminado</span>
		</div>
	    @endif
	</div>

	<form>
            <div class="card-body">
		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="codigo">Código del documento</label>
			    <input  value="{{ $documento->Codigo }}" type="text" class="form-control" id="codigo" name="codigo" maxlength="255" minlength="1" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="nombre">Nombre del documento</label>
			    <input value="{{ $documento->Nombre }}" type="text" class="form-control" id="nombre" name="nombre" maxlength="255" minlength="3" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Tipo de documento</label>
			    <input value="{{ $documento->Tipo }}" type="text" class="form-control" id="tipo" name="tipo" maxlength="255" minlength="3" disabled>
			</div>
		    </div>
		</div>

		<div class="row">

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Unidad</label>
			    <input value="{{ $documento->Unidad }}" type="text" class="form-control" id="unidad" name="unidad" maxlength="255" minlength="3" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="version">Versión actual del documento</label>
			    <input value="{{ $documento->Version }}" type="number" class="form-control" id="version" min="0" name="version" disabled>
			</div>
		    </div>


		    <div class="col-md-4">
			<div class="form-group">
			    <label for="ubicacion-fisica">Ubicación física del documento</label>
			    <input value="{{ $documento->UbicacionFisica }}" type="text" class="form-control" id="ubicacion-fisica" disabled>
			</div>
		    </div>


		</div>

		<div class="row">

		    <div class="col-md-6">
			<div class="form-group">
			    <label>Fecha de aprovación:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input value="{{ $documento->FechaAprovacion }}" type="text" name="fecha-aprovacion" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-6">
			<div class="form-group">
			    <label>Subido al sistema el:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input value="{{ $documento->FechaCreacion }}" type="text" name="fecha-aprovacion" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		</div>

		<div class="row">

		    @if ($documento->Estado === 1)
		    <div class="col-md-12">
			<div class="form-group">
			    <label for="estandares">Estandares</label>
			    <textarea id="estandares" class="form-control" cols="30" id="" name="" rows="5" disabled>
@foreach ($estandares as $estandar)
{{ $estandar->Numero . '. ' . $estandar->Estandar }}
@endforeach
			    </textarea>
			</div>

		    </div>
		    @endif

		</div>

	    </div>

            <div class="card-footer">
                <a href="{{ route('documentos-todos', $documento->IdGrupoDocumento) }}" class="btn btn-secondary">Volver</a>
            </div>
	</form>
    </div>

    <!-- Errores -->
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
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/dropzone/min/dropzone.min.css') }}">
@endsection()

@section('js')
    <script src="{{ asset('docsistemas/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/dropzone/min/dropzone.min.js') }}"></script>

@endsection()