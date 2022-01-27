@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Documentos ({{ $grupo->Nombre }}) de {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
		<div class="card-header">
                    <h3 class="card-title">
			@if ($bandera->get('VerTodos') === false)
			<a href="{{ route('documentos-vcrear', $grupo->IdGrupoDocumento) }}" type="button" class="btn btn-block btn-primary">
			    <i class="fa fa-plus"></i> Nuevo Documento
			</a>
			@endif
		    </h3>
		    <h3 class="card-tools">
			<a href="{{ route('subproceso-versubprocesos', $subProceso->IdSubProceso) }}" type="button" class="btn btn-block btn-secondary">
			    <i class="fa fa-angle-left"></i> Volver
			</a>
		    </h3>
		</div>

		<!-- /.card-header -->
		<div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
				<th>Ver</th>
				<th>Historial</th>
				<th>Código</th>
				<th>Nombre</th>
				@if($bandera->get('VerTodos') === true)
				<th>Grupo</th>
				@endif
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Emisión</th>
				<th>Fecha de Aprovación</th>
				<th>Versión Actual</th>
				<th>Estado</th>
				<th>Acciones</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($documentos as $documento)
				<tr>
				    @if ($documento->get('EstadoDocumento') === 1)
					<td><a href="{{ route('documentos-ver', $documento->get('IdDocumento')) }}" type="button" class="btn btn-primary btn-block" title="Ver documento"><i class="fa fa-eye"></i></a></td>
					<td><a href="{{ route('archivos-todos', $documento->get('IdDocumento')) }}" type="button" class="btn btn-primary btn-block" title="Ver historial"><i class="fa fa-book"></i></a></td>
				    @else
					<td><a href="{{ route('documentos-ver', $documento->get('IdDocumento')) }}" type="button" class="btn btn-danger btn-block" title="Ver documento"><i class="fa fa-eye"></i></a></td>
					<td><a href="{{ route('archivos-todos', $documento->get('IdDocumento')) }}" type="button" class="btn btn-danger btn-block" title="Ver historial"><i class="fa fa-book"></i></a></td>
				    @endif
				    <td>{{ $documento->get('CodigoDocumento') }}</td>
				    <td>{{ $documento->get('NombreDocumento') }}</td>
				    @if($bandera->get('VerTodos') === true)
				    <td>{{ $documento->get('NombreGrupoDocumento') }}</td>
				    @endif
				    <td>{{ $documento->get('NombreTipoDocumento') }}</td>
				    <td>{{ $documento->get('NombreUnidad') }}</td>
				    <td>{{ $documento->get('FechaEmisionDocumento') }}</td>
				    <td>{{ $documento->get('FechaAprovacionDocumento') }}</td>
				    <td>{{ $documento->get('VersionDocumento') }}</td>
				    @if ($documento->get('EstadoDocumento') === 1)
					<td class="text-center"><button type="button" class="btn btn-success" title="Activo"><i class="fa fa-check"></i></button></td>
					<td class="text-center">
					    <div class="btn-group">
						<a href="{{ route('documentos-descargar', $documento->get('IdDocumento')) }}" type="button" class="btn btn-secondary" title="Descargar la versión actual"><i class="fa fa-arrow-down"></i></a>
						<a href="{{ route('documentos-veditar',   $documento->get('IdDocumento')) }}" type="button" class="btn btn-warning" title="Editar documento"><i class="fas fa-pencil-alt"></i></a>
						<a type="button" class="btn btn-danger" id="eliminar" title="Eliminar documento" data-toggle="modal" data-target="#modal-eliminar" data-action="{{ route('documentos-eliminar', $documento->get('IdDocumento')) }}" data-nombre="{{ $documento->get('NombreDocumento') }}"><i class="fas fa-trash"></i></a>
					    </div>
					</td>
				    @else
					<td class="text-center"><button type="button" class="btn btn-danger" title="Eliminado"><i class="fa fa-ban"></i></button></td>
					<td class="text-center"></td>
				    @endif
				</tr>
			    @endforeach
			</tbody>

			<tfoot>
			    <tr>
				<th>Ver</th>
				<th>Historial</th>
				<th>Código</th>
				<th>Nombre</th>
				@if($bandera->get('VerTodos') === true)
				<th>Grupo</th>
				@endif
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Emisión</th>
				<th>Fecha de Aprovación</th>
				<th>Versión Actual</th>
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

    <div class="modal fade" id="modal-eliminar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
		<div class="card card-danger">
		    <div class="card-header">
			<h3 class="card-title">Eliminar documento</h3>
		    </div>
		    <form method="post" action="">
			@csrf
			@method('post')
			<div class="card-body">
			    <div class="form-group">
				<label>Motivo (opcional)</label>
				<textarea class="form-control" rows="3" name="motivo" placeholder="Ingrese el motivo de eliminar el documento..." maxlength="510"></textarea>
			    </div>
			</div>
			<div class="card-footer">
			    <button type="submit" class="btn btn-danger">Eliminar</button>
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			</div>
		    </form>
		</div>
	    </div>
	</div>
    </div>


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

     // Eliminar el documento
     $("#modal-eliminar").on("show.bs.modal", (evento) => {
	 let boton = evento.relatedTarget; // El boton de eliminar que se presiono
	 let form_action = boton.getAttribute("data-action");
	 let nombre = boton.getAttribute("data-nombre");
	 let titulo = $("#modal-eliminar").find(".card-title");
	 let formulario = $("#modal-eliminar").find("form");
	 titulo.text("Eliminar documento - " + nombre);
	 formulario.attr("action", form_action);
     });
     
    </script>


@endsection()
