@auth
@extends("layouts.index")
@section("main")

    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
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
            <form action="{{ route('medicamento.store') }}" method="post">

                @csrf

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

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeMedicamento" name="nome" value="{{ old('nome') }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <textarea name="descricao" id="descricao" cols="30" rows="2" class="form-control" value="{{ old('descricao') }}"></textarea>
                </div>

                <div class="mb-3">
                    <label for="risco" class="form-label">Risco</label>
                    <select class="form-select" aria-label="Default select example" name="risco"
                            value="{{ old('risco') }}">
                        <option value="" selected>Selecione o risco...</option>
                        <option value="contraindicado" style="color: red; font-weight: 600;">Contraindicado</option>
                        <option value="criterioso" style="color: yellow; font-weight: 600;">Criterioso</option>
                        <option value="compativel" style="color: green; font-weight: 600;">Compatível</option>
                    </select>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>

            <div class="table-responsive mt-4">
                <table id="table-medicamentos" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 30%;">Nome</th>
                            <th style="width: 30%;">Categoria</th>
                            <th style="width: 20%;">Risco</th>
                            <th style="width: 20%; text-align: right;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medicamentos as $medicamento)
                            <tr>
                                <td class='fw-bold'>{{ $medicamento->nome }}</td>
                                <td class='fw-bold'>{{ $medicamento->categoria->nome }}</td>
                                <td class='fw-bold'>{{ $medicamento->risco }}</td>
                                <td style='text-align:right;'>
                                    <a href='{{ route("medicamento.edit", ["id" => $medicamento->id]) }}' class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('medicamento.destroy', ['id' => $medicamento->id]) }}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($medicamentos) == 0)
                    <p class="text-center">Não existem medicamentos cadastrados no sistema</p>
                @endif
            </div>
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
@endauth
