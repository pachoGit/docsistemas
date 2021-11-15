<div class="small-box bg-{{ $tipo }}">
    <div class="inner">
	{{ $opciones }}
        <h3 class="truncar-texto" title="{{ $titulo }}">{{ $titulo }}</h3>
        <p class="truncar-texto" title="{{ $descripcion}}"> {{ $descripcion }}</p>
    </div>
    <a href="{{ route('documentos-todos', $idModal) }}" class="small-box-footer">
        Mostrar más <i class="fas fa-arrow-circle-right"></i>
    </a>
</div>
