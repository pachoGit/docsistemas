@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Documento de  {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    @if ($documento->get('EstadoDocumento') !== 0)
	<div class="card card-primary">
    @else
	<div class="card card-danger">
    @endif
	<div class="card-header">
            <h3 class="card-title">Agrupado en: {{ $documento->get('NombreGrupoDocumento') }}</h3>
	    @if ($documento->get('EstadoDocumento') !== 0)
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
			    <input  value="{{ $documento->get('CodigoDocumento') }}" type="text" class="form-control" id="codigo" name="codigo" maxlength="255" minlength="1" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="nombre">Nombre del documento</label>
			    <input value="{{ $documento->get('NombreDocumento') }}" type="text" class="form-control" id="nombre" name="nombre" maxlength="255" minlength="3" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Tipo de documento</label>
			    <input value="{{ $documento->get('NombreTipoDocumento') }}" type="text" class="form-control" id="tipo" name="tipo" maxlength="255" minlength="3" disabled>
			</div>
		    </div>
		</div>

		<div class="row">

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Unidad</label>
			    <input value="{{ $documento->get('NombreUnidad') }}" type="text" class="form-control" id="unidad" name="unidad" maxlength="255" minlength="3" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="version">Versión actual del documento</label>
			    <input value="{{ $documento->get('VersionDocumento') }}" type="number" class="form-control" id="version" min="0" name="version" disabled>
			</div>
		    </div>


		    <div class="col-md-4">
			<div class="form-group">
			    <label for="ubicacion-fisica">Ubicación física del documento</label>
			    <input value="{{ $documento->get('UbicacionFisicaDocumento') }}" type="text" class="form-control" id="ubicacion-fisica" disabled>
			</div>
		    </div>


		</div>

		<div class="row">

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de emisión de la versión actual:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input value="{{ $documento->get('FechaEmisionDocumento') }}" type="text" name="fecha-aprobacion" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>


		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de aprobación de la versión actual:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input value="{{ $documento->get('FechaAprobacionDocumento') }}" type="text" name="fecha-aprobacion" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>La versión actual ha sido subido al sistema el:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input value="{{ $documento->get('FechaCreacionDocumento') }}" type="text" name="fecha-aprobacion" class="form-control datetimepicker-input" data-target="#reservationdate" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		</div>


		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="resolucion-aprobacion">Resolución de aprobación</label>
			    <input type="text" value="{{ $documento->get("ResolucionAprobacionDocumento") }}" class="form-control" id="resolucion-aprobacion" placeholder="Ingrese la resolución de aprobación" maxlength="255" name="resolucion-aprobacion" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="resolucion-rectificacion">Resolución de rectificación</label>
			    <input type="text" value="{{ $documento->get("ResolucionRectificacionDocumento") }}" class="form-control" id="resolucion-rectificacion"  placeholder="Ingrese la resolución de rectificación" maxlength="255" name="resolucion-rectificacion" disabled>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label> Fecha de rectificación</label>
			    <div class="input-group date" id="reservationdate3" data-target-input="nearest">
				<input type="date" name="fecha-rectificacion" class="form-control datetimepicker-input" data-target="#reservationdate3" value="{{ $documento->get("FechaRectificacionDocumento") }}" max="{{ date('Y-m-d') }}" disabled/>
				<div class="input-group-append" data-target="#reservationdate3" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		</div>

		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="documento-referencia">Documento referencia</label>
			    <input type="text" class="form-control" value="{{ $documento->get("DocumentoReferenciaDocumento") }}" id="documento-referencia" placeholder="Ingrese el informe, acta o documento de referencia" maxlength="255" name="documento-referencia" disabled>
			</div>
		    </div>

		</div>

		<div class="row">

		    @if ($documento->get('EstadoDocumento') !== 0)
		    <div class="col-md-12">
			<div class="form-group">
			    <label for="estandares">Estándares</label>
			    <textarea id="estandares" class="form-control" cols="30" id="" name="" rows="5" disabled>
@foreach ($documento->get('EstandaresDocumento') as $estandar)
{{ $estandar->get('NumeroEstandar') . '. ' . $estandar->get('NombreEstandar') }}
@endforeach
			    </textarea>
			</div>

		    </div>
		    @else
		    <div class="col-md-6">
			<div class="form-group">
			    <label for="estandares">Estándares</label>
			    <textarea id="estandares" class="form-control" cols="30" id="" name="" rows="5" disabled>
@foreach ($documento->get('EstandaresDocumento') as $estandar)
{{ $estandar->get('NumeroEstandar') . '. ' . $estandar->get('NombreEstandar') }}
@endforeach
			    </textarea>
			</div>

		    </div>

		    <div class="col-md-6">
			<div class="form-group">
			    <label for="motivo">Motivo de la eliminación</label>
			    <textarea id="motivo" class="form-control" cols="30" id="" name="" rows="5" disabled>
				{{ $documento->get('MotivoEliminadoDocumento') }}
			    </textarea>
			</div>

		    </div>
		    
		    @endif

		</div>

		@if ($documento->get('EstadoDocumento') !== 0)

		    <div class="row">
			<div class="col-md-12">
			    <div class="form-group">
				<label for="observacion">Observaciones</label>
				<textarea id="observacion" class="form-control" cols="30" id="" rows="5" disabled>
{{ $documento->get('ObservacionDocumento') }}
				</textarea>
			    </div>
			</div>
		    </div>

		    <div class="row">
			<div class="col-md-4">
			    <div class="form-group">
				<label>Estado</label>
				@php
				$valor = ['25%', '50%', '75%', '100%'];
				@endphp
				<input value="{{ $valor[$documento->get('EstadoDocumento') - 1] }}" type="text" class="form-control" id="tipo" name="tipo" maxlength="255" minlength="3" disabled>
			    </div>
			</div>
		    </div>

		@endif

	    </div>

            <div class="card-footer">
		@if (!isset($redireccion))
                    <a href="{{ route('documentos-todos', $documento->get('IdGrupoDocumento')) }}" class="btn btn-secondary">Volver</a>
		@else
                    <a href="{{ route($redireccion['ruta'], $redireccion['id']) }}" class="btn btn-secondary">Volver</a>
		@endif
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
