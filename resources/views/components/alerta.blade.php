<div class="alert alert-{{ $tipo }} alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-{{ $icono }}"></i> {{ $titulo}} </h5>
    {{ $slot }}
</div>

