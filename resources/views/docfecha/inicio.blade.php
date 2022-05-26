@php

$item_proceso_activo = '';
$item_subproceso_activo = '';
$item_docfecha = ''; // Simplemente se usa como bandera para iluminar el item del menu

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Documentos por fecha
@endsection()

@section('contenido')

    <div class="card card-primary">
	<div class="card-header">
            <h3 class="card-title">Buscar documentos por fecha</h3>
	</div>
	
	<form method="post" action="{{ route('docfecha-documentos') }}">
	    @csrf
	    @method('post')
            <div class="card-body">
		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de inicio </label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				@php
				$fi = date('Y-m-d');
				if (isset($fechaInicio))
				$fi = $fechaInicio;
				@endphp
				<input type="date" name="fecha-inicio" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ $fi }}" max="{{ date('Y-m-d') }}" required/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha fin </label>
			    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
				@php
				$ff = date('Y-m-d');
				if (isset($fechaFin))
				$ff = $fechaFin;
				@endphp
				<input type="date" name="fecha-fin" class="form-control datetimepicker-input" data-target="#reservationdate2" value="{{ $ff }}" max="{{ date('Y-m-d') }}" required/>
				<div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>
		    
		    <div class="col-md-4">
			<div class="form-group">
			    <label>Tipo de fecha</label>
			    <select name="tipo-fecha" class="form-control select2bs4" style="width: 100%;" required>
				@php
				$seleccionado = ['', '', ''];
				if (isset($tipoFecha))
				{
				$indice = intval($tipoFecha) - 1;
				$seleccionado[$indice] = 'selected';
				}
				@endphp
				<option value="1" {{ $seleccionado[0] }}>Emisión</option>
				<option value="2" {{ $seleccionado[1] }}>Aprobación</option>
				<option value="3" {{ $seleccionado[2] }}>Subido al sistema</option>
			    </select>
			</div>
		    </div>
		</div>
	    </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
	</form>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
		<div class="card-header">
		    <h3 class="card-title">

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
			    @isset($documentos)
			    @foreach ($documentos as $documento)
				<tr>
				    <td>
					<div class="btn-group">
					    <a href="{{ route('docfecha-ver', $documento->get('IdDocumento')) }}" type="button" class="btn btn-primary btn-block" title="Ver documento"><i class="fa fa-eye"></i></a>
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
				    @if ($documento->get('EstadoDocumento') === 1)
					<td class="text-center"><button type="button" class="btn btn-success" title="Activo"><i class="fa fa-check"></i></button></td>
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
			    @endisset
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
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bs-stepper/css/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/dropzone/min/dropzone.min.css') }}">

    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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

    <script src="{{ asset('docsistemas/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <script>
     $(function () {

	 bsCustomFileInput.init();

	 //Initialize Select2 Elements
	 $('.select2').select2()

	 //Initialize Select2 Elements
	 $('.select2bs4').select2({
	     theme: 'bootstrap4'
	 })

	 //Datemask dd/mm/yyyy
	 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	 //Datemask2 mm/dd/yyyy
	 $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
	 //Money Euro
	 $('[data-mask]').inputmask()

	 //Date picker
	 $('#reservationdate').datetimepicker({
             format: 'YYYY-MM-DD'
	 });

	 $('#reservationdate2').datetimepicker({
             format: 'YYYY-MM-DD'
	 });

	 //Date and time picker
	 $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

	 //Date range picker
	 $('#reservation').daterangepicker()
	 //Date range picker with time picker
	 $('#reservationtime').daterangepicker({
	     timePicker: true,
	     timePickerIncrement: 30,
	     locale: {
		 format: 'MM/DD/YYYY hh:mm A'
	     }
	 })
	 //Date range as a button
	 $('#daterange-btn').daterangepicker(
	     {
		 ranges   : {
		     'Today'       : [moment(), moment()],
		     'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
		     'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
		     'Last 30 Days': [moment().subtract(29, 'days'), moment()],
		     'This Month'  : [moment().startOf('month'), moment().endOf('month')],
		     'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		 },
		 startDate: moment().subtract(29, 'days'),
		 endDate  : moment()
	     },
	     function (start, end) {
		 $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	     }
	 )

	 //Timepicker
	 $('#timepicker').datetimepicker({
	     format: 'LT'
	 })

	 //Bootstrap Duallistbox
	 $('.duallistbox').bootstrapDualListbox()

	 //Colorpicker
	 $('.my-colorpicker1').colorpicker()
	 //color picker with addon
	 $('.my-colorpicker2').colorpicker()

	 $('.my-colorpicker2').on('colorpickerChange', function(event) {
	     $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
	 })

	 $("input[data-bootstrap-switch]").each(function(){
	     $(this).bootstrapSwitch('state', $(this).prop('checked'));
	 })

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
     })

     // BS-Stepper Init
     document.addEventListener('DOMContentLoaded', function () {
	 window.stepper = new Stepper(document.querySelector('.bs-stepper'))
     })


    </script>

@endsection()


