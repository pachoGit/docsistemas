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
				<th>Código</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>Fecha de Aprovación</th>
				<th>Nro Versión</th>
			    </tr>
			</thead>
			<tbody>
			    <tr>
				<td>Trident</td>
				<td>Internet
				    Explorer 4.0
				</td>
				<td>Win 95+</td>
				<td> 4</td>
				<td>X</td>
			    </tr>
			</tbody>
			<tfoot>
			    <tr>
				<th>Rendering engine</th>
				<th>Browser</th>
				<th>Platform(s)</th>
				<th>Engine version</th>
				<th>CSS grade</th>
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
    </script>


@endsection()
