@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Historial de {{ $documento->Nombre }}
@endsection()

@section('contenido')

    <div class="row">
        <div class="col-12">
	    @if ($documento->Estado === 1)
		<div class="callout callout-info">
		    <h5>
			<i class="fas fa-info"></i> Versión actual: {{ $documento->Version }}
		    </h5>
		    @foreach ($archivos as $archivo)
			@if ($archivo->get('VersionArchivo') === $documento->Version)
			    Nombre del archivo: {{ $archivo->get('NombreArchivo') }}
			    <a href="{{ route('archivos-descargar', $archivo->get('IdArchivo')) }}" type="button" class="btn btn-success btn-sm ml-3" title="Descargar la versión actual"><i class="fa fa-arrow-down"></i> Descargar </a>
			@endif
		    @endforeach
		</div>
	    @else
		<div class="callout callout-danger">
		    <h5>
			<i class="fas fa-danger"></i> El documento ha sido eliminado
		    </h5>
		</div>
	    @endif

            <div class="card">
		<div class="card-header">
		    @if ($documento->Estado === 1)
			<h3 class="card-title">
			    <a href="{{ route('archivos-vcrear', $documento->IdDocumento) }}" type="button" class="btn btn-block btn-primary" title="Crear una nueva versión del documento">
				<i class="fa fa-plus"></i> Nueva Versión
			    </a>
			</h3>
			<h3 class="card-tools">
			    <a href="{{ route('documentos-todos', $documento->IdGrupoDocumento) }}" type="button" class="btn btn-block btn-secondary">
				<i class="fa fa-angle-left"></i> Volver
			    </a>
			</h3>
		    @else
			<h3 class="card-title">
			    <a href="{{ route('documentos-todos', $documento->IdGrupoDocumento) }}" type="button" class="btn btn-block btn-secondary">
				<i class="fa fa-angle-left"></i> Volver
			    </a>
			</h3>
		    @endif
		</div>

		<!-- /.card-header -->
		<div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Fecha de Aprovación</th>
				<th>Fecha de Modificación</th>
				<th>Motivo del cambio</th>
				<th>Versión</th>
				<th>Estado</th>
				<th>Acciones</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($archivos as $archivo)
				<tr>
				    @if ($documento->Estado == 1)
					@if ($archivo->get('EstadoArchivo') === 1)
					    @if ($archivo->get('VersionArchivo') !== $documento->Version)
						<td><a href="{{ route('archivos-haceractual', $archivo->get('IdArchivo')) }}" type="button" class="btn btn-primary btn-block" title="Convertir en la versión actual"><i class="fa fa-arrow-up"></i></a></td>
					    @else
						<td></td>
					    @endif
					@else
					    <td></td>
					@endif
				    @else
					<td></td>
				    @endif
				    <td>{{ $archivo->get('NombreArchivo') }}</td>
				    <td>{{ $archivo->get('FechaAprovacionArchivo') }}</td>
				    <td>{{ $archivo->get('FechaModificacionArchivo') }}</td>
				    <td>{{ $archivo->get('MotivoCambioArchivo') }}</td>
				    <td>{{ $archivo->get('VersionArchivo') }}</td>
				    @if ($archivo->get('EstadoArchivo') === 1)
					<td class="text-center">
					    @if ($documento->Estado === 1)
						<button type="button" class="btn btn-success" title="Activo"><i class="fa fa-check"></i></button>
					    @else
						<button type="button" class="btn btn-danger" title="Eliminado"><i class="fa fa-ban"></i></button>
					    @endif
					</td>
					<td class="text-center">
					    @if ($documento->Estado === 1)
					    <div class="btn-group">
						<a href="{{ route('archivos-descargar', $archivo->get('IdArchivo')) }}" type="button" class="btn btn-secondary" title="Descargar esta versión"><i class="fa fa-arrow-down"></i></a>
						<a href="{{ route('archivos-veditar',  $archivo->get('IdArchivo')) }}" type="button" class="btn btn-warning" title="Editar archivo"><i class="fas fa-pencil-alt"></i></a>
						<a href="{{ route('archivos-eliminar',  $archivo->get('IdArchivo')) }}" type="button" class="btn btn-danger" id="eliminar" title="Eliminar archivo" onclick="return confirm('¿Desea eliminar esta versión?')"><i class="fas fa-trash"></i></a>
					    </div>
					    @endif
					</td>
				    @else
					<td class="text-center"><button type="button" class="btn btn-danger" title="Eliminado"><i class="fa fa-trash"></i></button></td>
					<td class="text-center"></td>
				    @endif
				</tr>
			    @endforeach
			</tbody>

			<tfoot>
			    <tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Fecha de Aprovación</th>
				<th>Fecha de Modificación</th>
				<th>Motivo del cambio</th>
				<th>Versión</th>
				<th>Estado</th>
				<th>Acciones</th>
			    </tr>
			</tfoot>
                    </table>
		</div>
		<!-- /.card-body -->

            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

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

@endsection()

@section('css')

    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

@endsection()

@section('js')

    <script src="{{ asset('docsistemas/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
     $(function () {
	 $("#example1").DataTable({
	     "responsive": true, "lengthChange": false, "autoWidth": false
	 }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	 $('#example2').DataTable({
	     "paging": true,
	     "lengthChange": false,
	     "searching": false,
	     "ordering": true,
	     "info": true,
	     "autoWidth": false,
	     "responsive": true,
	 });
     });

     // Ocultar la alerta
     $("#alerta").hide(5000);

     // Eliminar el archivo
     $("#modal-eliminar").on("show.bs.modal", (evento) => {
	 let boton = evento.relatedTarget; // El boton de eliminar que se presiono
	 let form_action = boton.getAttribute("data-action");
	 let nombre = boton.getAttribute("data-nombre");
	 let titulo = $("#modal-eliminar").find(".card-title");
	 let formulario = $("#modal-eliminar").find("form");
	 titulo.text("Eliminar archivo - " + nombre);
	 formulario.attr("action", form_action);
     });
     
    </script>


@endsection()
