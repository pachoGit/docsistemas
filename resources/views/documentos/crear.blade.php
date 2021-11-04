@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Nuevo documento para {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    <div class="card card-primary">
	<div class="card-header">
            <h3 class="card-title">Nuevo documento</h3>
	</div>

	<form>
            <div class="card-body">
		<div class="row">
		    <div class="col-md-6">
			<div class="form-group">
			    <label for="codigo">Código del documento</label>
			    <input type="text" class="form-control" id="codigo" placeholder="Ingrese el código del documento" maxlength="255">
			</div>

			<div class="form-group">
			    <label>Tipo de documento</label>
			    <select name="tipo" class="form-control select2bs4" style="width: 100%;">
				@foreach ($tipos as $tipo)
				    <option value="{{ $tipo->IdTipoDocumento }}">{{ $tipo->Nombre }}</option>
				@endforeach
			    </select>
			</div>
		    </div>

		    <div class="col-md-6">
			<div class="form-group">
			    <label for="nombre">Nombre del documento</label>
			    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del documento" maxlength="255" minlength="3">
			</div>

			<div class="form-group">
			    <label>Unidad</label>
			    <select name="unidad" class="form-control select2bs4" style="width: 100%;">
				@foreach ($unidades as $unidad)
				    <option value="{{ $unidad->IdUnidad }}">{{ $unidad->Nombre }}</option>
				@endforeach
			    </select>
			</div>
		    </div>
		    
		</div>

		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="ubicacion">Ubicación del documento</label>
			    <input type="text" class="form-control" id="ubicacion" placeholder="Ingrese el ubicación del documento" maxlength="255">
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de aprovación:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="version">Versión del documento</label>
			    <input type="number" class="form-control" id="version" min="0" placeholder="Ingrese la versión del documento">
			</div>
		    </div>

		</div>

                <div class="form-group">
		    <label for="archivo">Subir archivo</label>
		    <div class="input-group">
			<div class="custom-file">
			    <input name="archivo" type="file" class="custom-file-input" id="archivo" accept="application/pdf, application/msword, .doc, .docx">
			    <label class="custom-file-label" for="archivo">Elija el archivo</label>
			</div>
			<div class="input-group-append">
			    <span class="input-group-text">Subir</span>
			</div>
		    </div>
                </div>

	    </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary">Cancelar</button>
            </div>
	</form>
    </div>

@endsection()

@section('css')
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('docsistemas/plugins/bs-stepper/css/bs-stepper.min.css') }}">
@endsection()

@section('js')
    <script src="{{ asset('docsistemas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
    <script src="{{ asset('docsistemas/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
     $(function () {
	 //Initialize Select2 Elements
	 $('.select2').select2()

	 $('.select2bs4').select2({                                                                                                          
	     theme: 'bootstrap4'                                                                                                               
	 })

	 $(function () {
	     bsCustomFileInput.init();
	 });

	 //Datemask dd/mm/yyyy
	 $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	 //Datemask2 mm/dd/yyyy
	 $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
	 //Money Euro
	 $('[data-mask]').inputmask()

	 //Date picker
	 $('#reservationdate').datetimepicker({
             format: 'L'
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


	 $("input[data-bootstrap-switch]").each(function(){
	     $(this).bootstrapSwitch('state', $(this).prop('checked'));
	 })

     })
     // BS-Stepper Init
     document.addEventListener('DOMContentLoaded', function () {
	 window.stepper = new Stepper(document.querySelector('.bs-stepper'))
     })

    </script>

@endsection()
