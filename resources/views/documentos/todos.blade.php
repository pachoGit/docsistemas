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
			<a href="{{ route('documentos-vcrear', $grupo->IdGrupoDocumento) }}" type="button" class="btn btn-block btn-outline-primary">
			    <i class="fa fa-plus"></i> Nuevo Documento
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
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Aprovación</th>
				<th>Fecha de Creación</th>
				<th>Versión Actual</th>
				<th>Estado</th>
				<th>Acciones</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($documentos as $documento)
				<tr>
				    <td><a href="{{ route('documentos-ver', $documento->IdDocumento) }}" type="button" class="btn btn-primary btn-block" title="Ver documento"><i class="fa fa-eye"></i></a></td>
				    <td><a href="" type="button" class="btn btn-primary btn-block" title="Ver historial"><i class="fa fa-book"></i></a></td>
				    <td>{{ $documento->Codigo }}</td>
				    <td>{{ $documento->DNombre }}</td>
				    <td>{{ $documento->TNombre }}</td>
				    <td>{{ $documento->UNombre }}</td>
				    <td>{{ $documento->FechaAprovacion }}</td>
				    <td>{{ $documento->FechaCreacion }}</td>
				    <td>{{ $documento->Version }}</td>
				    <td class="text-center"><button type="button" class="btn btn-success" title="Activo"><i class="fa fa-check"></i></button></td>
				    <td class="text-center">
					<div class="btn-group">
					    <a type="button" class="btn btn-secondary" title="Descargar la versión actual"><i class="fa fa-arrow-down"></i></a>
					    <a type="button" class="btn btn-warning" title="Editar documento"><i class="fas fa-pencil-alt"></i></a>
					    <a type="button" class="btn btn-danger" title="Eliminar documento"><i class="fas fa-trash"></i></a>
					</div>
				    </td>
				</tr>
			    @endforeach
			</tbody>

			<tfoot>
			    <tr>
				<th>Ver</th>
				<th>Historial</th>
				<th>Código</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Aprovación</th>
				<th>Fecha de Creación</th>
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
	@endif
    @endif

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
	     "responsive": true, "lengthChange": false, "autoWidth": false,
	     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
     
    </script>


@endsection()
