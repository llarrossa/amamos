@extends('layouts.index')

@section('main')
<div class="container">
    <div class="col-12 col-md-9">
        <form action="/buscar/categoria" method="GET">
            <p class="h5 mb-3">Buscar pela categoria do medicamento</p>
            
            <div class="mb-3">
               <label for="categoria" class="form-label">Categoria:</label>
               <select class="form-select" name="categoria" id="categoria" tabindex="1" required>
                   <option value="">Selecione</option>
                   @foreach ($categorias->where('tipo', 'cat') as $categoria)
                       <option value="{{ $categoria->id }}">
                           {{ $categoria->nome }}
                       </option>
                   @endforeach
               </select>
            </div>

            <div class="mb-3" id="subcategoria-container" style="display:none;">
                <label for="categoria_id" class="form-label">Subcategoria:</label>
                <select class="form-select" name="categoria_id" id="categoria_id" tabindex="1">
                    <option value="">Selecione</option>
                </select>
            </div>
           
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
        
        @if(request()->has('categoria_id'))
            @if($medicamentos->isNotEmpty())
                <div class="list-group w-100 mt-3" style="background-color: #fff;">
                    @foreach($medicamentos as $medicamento)
                        <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #bebebf;">
                            <div class="d-flex flex-column flex-sm-row w-100 justify-content-between">
                                <h5 class="mb-1">{{ $medicamento->nome }}</h5>
                                <small class="risco">{{ $medicamento->risco }}</small>
                            </div>
                            <p class="mb-1">{{ $medicamento->descricao }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="mt-5">Nenhum medicamento encontrado para a categoria selecionada.</p>
            @endif
        @endif
    </div>
</div>

<script>
$(document).ready(function() {
    $('#categoria').on('change', function() {
        var categoriaId = $(this).val();
        var $subCategoriaSelect = $('#categoria_id');
        var $subCategoriaContainer = $('#subcategoria-container');
        
        if (categoriaId) {
            $.ajax({
                url: '/categorias/' + categoriaId,
                type: 'GET',
                success: function(data) {
                    $subCategoriaSelect.empty().append('<option value="">Selecione</option>');
                    $.each(data, function(index, categoria) {
                        $subCategoriaSelect.append('<option value="' + categoria.id + '">' + categoria.nome + '</option>');
                    });
                    $subCategoriaContainer.show();
                },
                error: function() {
                    console.error('Erro ao carregar subcategorias.');
                }
            });
        } else {
            $subCategoriaContainer.hide().find('select').empty().append('<option value="">Selecione</option>');
        }
    });
});
</script>
@endsection
