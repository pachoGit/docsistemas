@php

$item_proceso_activo = '';
$item_subproceso_activo = '';
$item_docestandar = ''; // Simplemente se usa como bandera para iluminar el item del menu

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina', 'Documentos por Estandar')

@section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
		<!-- 
		<div class="card-header">
		    <h3 class="card-title">

		    </h3>
		</div>
		-->
		<div class="card-body">
		    <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Documentos</th>
				<th>Acciones</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($estandares as $estandar)
				<tr>
				    <td>{{ $estandar->get('NumeroEstandar') }}</td>
				    <td>{{ $estandar->get('NombreEstandar') }}</td>
				    <td>{{ $estandar->get('CantidadDocumentos') }}</td>
				    <td class="text-center">
					<div class="btn-group">
					    <a href="{{ route('docestandar-documentos', $estandar->get('IdEstandar')) }}" type="button" class="btn btn-primary btn-block" title="Ver documentos"><i class="fa fa-eye"></i></a>
					</div>
				    </td>
				</tr>
			    @endforeach
			</tbody>

			<tfoot>
			    <tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Documentos</th>
				<th>Acciones</th>
			    </tr>
			</tfoot>
		    </table>
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
     $("#alerta").hide(10000);

    </script>


@endsection()
