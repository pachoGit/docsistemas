@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Editar documento de {{ $subProceso->Nombre }}
@endsection()

@section('contenido')

    <div class="row">
	<div class="col-12">
	    <div class="callout callout-info">
		<h5>
		    <i class="fas fa-info"></i> Nota
		</h5>
		Para editar los campos bloqueados tendrá que realizarlo a la versión actual del documento
	    </div>
	</div>
    </div>

    <div class="card card-primary">
	<div class="card-header">
            <h3 class="card-title">Editar documento ({{ $documento->get('NombreGrupoDocumento') }})</h3>
	</div>

	<form method="post" action="{{ route('documentos-editar', $documento->get('IdDocumento')) }}">
	    @csrf
	    @method('post')
            <div class="card-body">
		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="codigo">Código del documento</label>
			    <input type="text" value="{{ $documento->get('CodigoDocumento') }}" class="form-control" id="codigo" name="codigo" placeholder="Ingrese el código del documento" maxlength="255">
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="nombre">Nombre del documento</label>
			    <input type="text" value="{{ $documento->get('NombreDocumento') }}" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del documento" maxlength="255" minlength="3" required>
			</div>
		    </div>
		    
		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de emisión de la versión actual:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input type="date" value="{{ $documento->get('FechaEmisionDocumento')}}" name="fecha-documento" class="form-control datetimepicker-input" data-target="#reservationdate" max="{{ date('Y-m-d') }}" disabled/>
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
			    <label>Tipo de documento</label>
			    <select name="tipo" class="form-control select2bs4" style="width: 100%;" required>
				@foreach ($tipos as $tipo)
				    @if ($tipo->IdTipoDocumento === $documento->get('IdTipoDocumento'))
					<option value="{{ $tipo->IdTipoDocumento }}" selected>{{ $tipo->Nombre }}</option>
				    @else
					<option value="{{ $tipo->IdTipoDocumento }}">{{ $tipo->Nombre }}</option>
				    @endif
				@endforeach
			    </select>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Unidad</label>
			    <select name="unidad" class="form-control select2bs4" style="width: 100%;" required>
				@foreach ($unidades as $unidad)
				    @if ($unidad->IdUnidad === $documento->get('IdUnidad'))
					<option value="{{ $unidad->IdUnidad }}" selected>{{ $unidad->Nombre }}</option>
				    @else
					<option value="{{ $unidad->IdUnidad }}">{{ $unidad->Nombre }}</option>
				    @endif
				@endforeach
			    </select>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Estándares</label>
			    <select name="estandares[]" class="select2bs4" multiple data-placeholder="Seleccione los estandares"
				    style="width: 100%;" required>
				@php
				$encontro = false;
				foreach ($estandares as $estandar) {
				foreach ($documento->get('EstandaresDocumento') as $docEstandar) {
				if ($estandar->IdEstandar === $docEstandar->get('IdEstandar')) {
				$encontro = true;
				@endphp
				<option value="{{ $estandar->IdEstandar }}" selected>{{ $estandar->Numero . '. ' . $estandar->Nombre }}</option>
				@php
				break;
				}
				}
				if ($encontro === false) {
				@endphp
				<option value="{{ $estandar->IdEstandar }}">{{ $estandar->Numero . '. ' . $estandar->Nombre }}</option>
				@php
				}
				else {
				$encontro = false;
				}
				}
				@endphp
			    </select>
			</div>
		    </div>

		</div>

		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="ubicacion-fisica">Ubicación física del documento</label>
			    <input type="text" value="{{ $documento->get('UbicacionFisicaDocumento') }}" class="form-control" id="ubicacion-fisica" placeholder="Ingrese el ubicación del documento" maxlength="255" minlength="3" name="ubicacion-fisica">
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de aprobación de la versión actual:</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input type="date" value="{{ $documento->get('FechaAprobacionDocumento')}}" name="fecha-aprobacion" class="form-control datetimepicker-input" data-target="#reservationdate" max="{{ date('Y-m-d') }}" disabled/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="version">Versión actual del documento</label>
			    <input type="number" value="{{ $documento->get('VersionDocumento') }}" class="form-control" id="version" min="0" placeholder="Ingrese la versión del documento" name="version" readonly>
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
		    <div class="col-md-12">
			<div class="form-group">
			    <label for="observacion">Observaciones</label>
			    <textarea id="observacion" class="form-control" name="observacion" cols="30" id="" rows="5" maxlength="400">
{{ $documento->get('ObservacionDocumento') }}
			    </textarea>
			</div>
		    </div>
		</div>


		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label>Estado</label>
			    <select name="estado" class="form-control select2bs4" style="width: 100%;" required>
				@php
				$seleccionado = ['', '', '', ''];
				$seleccionado[$documento->get('EstadoDocumento') - 1] = 'selected';
				@endphp
				<option value="1" {{ $seleccionado[0] }}>25%</option>
				<option value="2" {{ $seleccionado[1] }}>50%</option>
				<option value="3" {{ $seleccionado[2] }}>75%</option>
				<option value="4" {{ $seleccionado[3] }}>100%</option>
			    </select>
			</div>
		    </div>
		</div>

	    </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Editar</button>
                <a href="{{ route('documentos-todos', $documento->get('IdGrupoDocumento')) }}" class="btn btn-secondary">Cancelar</a>
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

     })
     // BS-Stepper Init
     document.addEventListener('DOMContentLoaded', function () {
	 window.stepper = new Stepper(document.querySelector('.bs-stepper'))
     })
     // DropzoneJS Demo Code Start
     Dropzone.autoDiscover = false

     // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
     var previewNode = document.querySelector("#template")
     previewNode.id = ""
     var previewTemplate = previewNode.parentNode.innerHTML
     previewNode.parentNode.removeChild(previewNode)

     var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
	 url: "/target-url", // Set the url
						    thumbnailWidth: 80,
						    thumbnailHeight: 80,
						    parallelUploads: 20,
						    previewTemplate: previewTemplate,
						    autoQueue: false, // Make sure the files aren't queued until manually added
						    previewsContainer: "#previews", // Define the container to display the previews
						    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
     })

     myDropzone.on("addedfile", function(file) {
	 // Hookup the start button
	 file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
     })

     // Update the total progress bar
     myDropzone.on("totaluploadprogress", function(progress) {
	 document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
     })

     myDropzone.on("sending", function(file) {
	 // Show the total progress bar when upload starts
	 document.querySelector("#total-progress").style.opacity = "1"
	 // And disable the start button
	 file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
     })

     // Hide the total progress bar when nothing's uploading anymore
     myDropzone.on("queuecomplete", function(progress) {
	 document.querySelector("#total-progress").style.opacity = "0"
     })

     // Setup the buttons for all transfers
     // The "add files" button doesn't need to be setup because the config
     // `clickable` has already been specified.
     document.querySelector("#actions .start").onclick = function() {
	 myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
     }
     document.querySelector("#actions .cancel").onclick = function() {
	 myDropzone.removeAllFiles(true)
     }
     // DropzoneJS Demo Code End

     // Para las alertas
     $("#alerta").hide(10000);
    </script>

@endsection()
