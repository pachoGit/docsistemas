<div class="small-box bg-{{ $tipo }}">
    <div class="inner">
        <a href="{{ route('grupo-eliminar', $idModal) }}" type="button" class="close" id="boton-eliminar-grupo-{{ $idModal }}" onclick="return confirm('Seguro que desea eliminar?');" title="Eliminar">&times;</a>
        <button type="button" class="close" title="Editar" data-toggle="modal" data-target="#editar-grupo-{{ $idModal }}" style="padding-right: 10px;">&#43;</button>
        <h3 class="truncar-texto" title="{{ $titulo }}">{{ $titulo }}</h3>
        <p class="truncar-texto" title="{{ $descripcion}}"> {{ $descripcion }}</p>
    </div>
    <a href="{{ route('documentos-todos', $idModal) }}" class="small-box-footer">
        Mostrar más <i class="fas fa-arrow-circle-right"></i>
    </a>
</div>
