@auth
@extends("layouts.index")
@section("main")

    <div class="row justify-content-center">
        <div class="col-9">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    Não foi possível realizar esta operação:
                    <ul class="mt-2 mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('medicamento.update', ['id' => $medicamento['id']]) }}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeMedicamento" name="nome" value="{{ $medicamento['nome'] }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="2" class="form-control" placeholder="Digite...">{{ $medicamento['descricao'] }}</textarea>
                </div>


                <div class="mb-3">
                    <label for="risco" class="form-label">Risco</label>
                    <select class="form-select" aria-label="Default select example" name="risco">
                        <option value="" @selected(!isset($medicamento['risco']))>Selecione o risco...</option>
                        <option value="contraindicado" style="color: red; font-weight: 600;" @selected($medicamento['risco'] == 'contraindicado')>Contraindicado</option>
                        <option value="criterioso" style="color: yellow; font-weight: 600;" @selected($medicamento['risco'] == 'criterioso')>Criterioso</option>
                        <option value="compativel" style="color: green; font-weight: 600;" @selected($medicamento['risco'] == 'compativel')>Compatível</option>
                    </select>
                </div>


                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     $('#categoria').on('change', function() {
        //         var categoriaId = $(this).val();
        //         var $subCategoriaSelect = $('#categoria_id');
        //         var $subCategoriaContainer = $('#subcategoria-container');
                
        //         if (categoriaId) {
        //             $.ajax({
        //                 url: '/categorias/' + categoriaId,
        //                 type: 'GET',
        //                 success: function(data) {
        //                     $subCategoriaSelect.empty().append('<option value="">Selecione</option>');
        //                     $.each(data, function(index, categoria) {
        //                         $subCategoriaSelect.append('<option value="' + categoria.id + '">' + categoria.nome + '</option>');
        //                     });
        //                     $subCategoriaContainer.show();
        //                 },
        //                 error: function() {
        //                     console.error('Erro ao carregar subcategorias.');
        //                 }
        //             });
        //         } else {
        //             $subCategoriaContainer.hide().find('select').empty().append('<option value="">Selecione</option>');
        //         }
        //     });
        // });
    </script>

@endsection
@endauth