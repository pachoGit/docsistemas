@php

$item_proceso_activo = $procesoPadre->Nombre;
$item_subproceso_activo = $subProceso->Nombre;

@endphp

@extends('esqueleto/esqueleto')

@section('titulo-pagina')
    Editar versión de {{ $archivo->get('NombreDocumento') }}
@endsection()

@section('contenido')

    <!-- 
    <div class="callout callout-info">
	<h5>
	    <i class="fas fa-info"></i> Nota: 
	    Al crear un nuevo archivo, este será la versión más reciente, es decir, reemplazará a la versión actual
	</h5>
    </div>
    -->

    <div class="card card-primary">
	<div class="card-header">
            <h3 class="card-title">Editar versión</h3>
	</div>

	<form method="post" action="{{ route('archivos-editar', $archivo->get('IdArchivo')) }}" enctype="multipart/form-data">
	    @csrf
	    @method('post')
            <div class="card-body">
		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label for="codigo">Número de versión *</label>
			    <input value="{{ $archivo->get('VersionArchivo') }}" type="number" class="form-control" id="version" name="version" placeholder="Ingrese el número de versión" min="0" required>
			</div>
		    </div>


		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de aprobación de la versión</label>
			    <div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input type="date" name="fecha-aprobacion" class="form-control datetimepicker-input" value="{{ $archivo->get('FechaAprobacionArchivo') }}" data-target="#reservationdate" max="{{ date('Y-m-d') }}"/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
				    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			    </div>
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label>Fecha de emisión de la versión *</label>
			    <div class="input-group date" id="reservationdate2" data-target-input="nearest">
				<input type="date" name="fecha-emision" class="form-control datetimepicker-input" value="{{ $archivo->get('FechaEmisionArchivo') }}" data-target="#reservationdate" max="{{ date('Y-m-d') }}" required/>
				<div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
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
			    <input type="text" class="form-control" id="resolucion-aprobacion" placeholder="Ingrese la resolución de aprobación" value="{{ $archivo->get('ResolucionAprobacionArchivo') }}" maxlength="255" name="resolucion-aprobacion">
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label for="resolucion-rectificacion">Resolución de rectificación</label>
			    <input type="text" class="form-control" id="resolucion-rectificacion"  placeholder="Ingrese la resolución de rectificación" value="{{ $archivo->get('ResolucionRectificacionArchivo') }}" maxlength="255" name="resolucion-rectificacion">
			</div>
		    </div>

		    <div class="col-md-4">
			<div class="form-group">
			    <label> Fecha de rectificación</label>
			    <div class="input-group date" id="reservationdate3" data-target-input="nearest">
				<input type="date" name="fecha-rectificacion" class="form-control datetimepicker-input" data-target="#reservationdate3" value="{{ $archivo->get('FechaRectificacionArchivo') }}" max="{{ date('Y-m-d') }}" />
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
			    <input type="text" class="form-control" id="documento-referencia" placeholder="Ingrese el informe, acta o documento de referencia" value="{{ $archivo->get('DocumentoReferenciaArchivo') }}" maxlength="255" name="documento-referencia">
			</div>
		    </div>

		</div>


		<div class="row">

		    <div class="col-md-12">
			<div class="form-group">
			    <label>Motivo del cambio (opcional)</label>
			    <textarea class="form-control" rows="3" name="motivo" placeholder="Ingrese el motivo de crear la nueva versión..." maxlength="510">
{{ $archivo->get('MotivoCambioArchivo')}}
			    </textarea>
			</div>
		    </div>

		</div>

		<div class="row">

		    <div class="col-md-12">
			<div class="form-group">
			    <label for="exampleInputFile">Subir archivo *</label>
			    <div class="input-group">
				<div class="custom-file">
				    <input name="archivo" type="file" class="custom-file-input" id="exampleInputFile" accept="application/pdf, application/msword, .doc, .docx .pdf">
				    <label class="custom-file-label" for="exampleInputFile">{{ $archivo->get('NombreArchivo')}}</label>
				</div>
				<div class="input-group-append">
				    <span class="input-group-text">Subir</span>
				</div>
			    </div>
			</div>
		    </div>

		</div>

	    </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Aceptar</button>
                <a href="{{ route('archivos-todos', $archivo->get('IdDocumento')) }}" class="btn btn-secondary">Cancelar</a>
            </div>
	</form>
    </div>

    <!-- Errores de la funcion validate de la clase Request -->
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

     // Para las alertas
     $("#alerta").hide(10000);

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

	 $('#reservationdate3').datetimepicker({
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


    </script>

@endsection()
