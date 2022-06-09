@php

$item_proceso_activo = '';
$item_subproceso_activo = '';
$item_docprocesos = ''; // Simplemente se usa como bandera para iluminar el item del menu

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Documentos de {{ $proceso->get('NombreProceso') }}
@endsection()

@section('contenido')

    <div class="row">
        <div class="col-12">
            <div class="card">
		<div class="card-header">
		    <h3 class="card-title">
			<a href="{{ route('docprocesos-inicio') }}" class="btn btn-secondary">
			    <i class="fa fa-angle-left"></i> Volver
			</a>
		    </h3>
		</div>
		<div class="card-body">
		    <table id="example1" class="table table-bordered table-striped">
			<thead>
			    <tr>
				<th>Ver</th>
				<th>Código</th>
				<th>Nombre</th>
				<th>Proceso</th> <!-- En realidad el subproceso de acuerdo a los registros :D  -->
				<th>Grupo</th>
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Emisión</th>
				<th>Fecha de Aprobación</th>
				<th>Versión Actual</th>
				<th>Estado</th>
				<th>Acciones</th>
			    </tr>
			</thead>

			<tbody>
			    @php
			    $data = [
			    ['bg-danger',  '25%'],
			    ['bg-warning', '50%'],
			    ['bg-info',    '75%'],
			    ['bg-success', '100%']
			    ];
			    @endphp
			    @foreach ($documentos as $documento)
				<tr>
				    <td>
					<div class="btn-group">
					    <a href="{{ route('docprocesos-ver', [$documento->get('IdDocumento'), $proceso->get('IdProceso')]) }}" type="button" class="btn btn-primary btn-block" title="Ver documento"><i class="fa fa-eye"></i></a>
					</div>
				    </td>
				    <td>{{ $documento->get('CodigoDocumento') }}</td>
				    <td>{{ $documento->get('NombreDocumento') }}</td>
				    <td>{{ $documento->get('NombreSubProceso') }}</td>
				    <td>{{ $documento->get('NombreGrupoDocumento') }}</td>
				    <td>{{ $documento->get('NombreTipoDocumento') }}</td>
				    <td>{{ $documento->get('NombreUnidad') }}</td>
				    <td>{{ $documento->get('FechaEmisionDocumento') }}</td>
				    <td>{{ $documento->get('FechaAprobacionDocumento') }}</td>
				    <td>{{ $documento->get('VersionDocumento') }}</td>	
				    @if ($documento->get('EstadoDocumento') !== 0)
					@php
					$infoEstado = $data[$documento->get('EstadoDocumento') - 1];
					@endphp
					<td class="text-center"><span class="badge {{ $infoEstado[0] }}">{{ $infoEstado[1] }}</span></td>
					<td class="text-center">
					    <div class="btn-group">
						<a href="{{ route('documentos-descargar', $documento->get('IdDocumento')) }}" type="button" class="btn btn-secondary" title="Descargar la versión actual"><i class="fa fa-arrow-down"></i></a>
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
				<th>Código</th>
				<th>Nombre</th>
				<th>Proceso</th> <!-- En realidad el subproceso de acuerdo a los registros :D  -->
				<th>Grupo</th>
				<th>Tipo</th>
				<th>Unidad</th>
				<th>Fecha de Emisión</th>
				<th>Fecha de Aprobación</th>
				<th>Versión Actual</th>
				<th>Estado</th>
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


