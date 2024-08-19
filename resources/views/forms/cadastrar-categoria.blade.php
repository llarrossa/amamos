@auth
@extends("layouts.index")
@section("main")

    @push('categoria')
        <style>
            @media (max-width: 767px) {
                .table thead {
                    display: none;
                }

                .table td {
                    display: flex;
                    justify-content: space-between;
                }

                .table tr {
                    display: block;
                }

                .table td:first-of-type {
                    font-weight: bold;
                    font-size: 1.2rem;
                    text-align: center;
                    display: block;
                }

                .table td:not(:first-of-type):before {
                    content: attr(data-title);
                    display: block;
                    font-weight: bold;
                }
            }

        </style>
    @endpush

    <div class="col-md-8 mx-auto justify-content-center align-items-center flex-column">
        @if (session()->has('errors'))
            <div class="alert alert-danger">
                {{ session('errors')->first() }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <form class="row g-2" action="{{ route('categoria.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <label for="tipo" class="form-label">
                    <h4>O que você deseja cadastrar?</h4>
                </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="cat" id="cat" name="tipo">
                    <label class="form-check-label" for="cat">
                        <h5>Categoria</h5>
                    </label>
                </div>  

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="sub" id="sub" name="tipo">
                    <label class="form-check-label" for="sub">
                        <h5>Subcategoria</h5>
                    </label>
                </div>

                <div id="categoriaSelectContainer" class="mt-3" style="display: none;">
                    <label for="id_pai" class="form-label"><h4>Selecione a categoria relacionada:</h4></label>
                    <select name="id_pai" id="id_pai" class="form-select mb-3">
                        <option value="">Selecione uma Categoria</option>
                        @foreach ($categorias as $categoria)
                            @if ($categoria['tipo'] === 'cat' && $categoria['id_pai'] === null)
                                <option value="{{ $categoria['id'] }}">{{ $categoria['nome'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="formNameCategoria d-none">
                    <label for="nome_categoria" class="form-label">
                        <h4>Nome da Categoria:</h4>
                    </label>
                    <input type="text" class="form-control  mb-3" name="nomeCat" id="nome_categoria" placeholder="Nome da categoria" tabindex="1">
                </div>

                <div class="formNameSubcategoria d-none">
                    <label for="nome_subcategoria" class="form-label">
                        <h4>Nome da Subcategoria:</h4>
                    </label>
                    <input type="text" class="form-control mb-3" name="nomeSub" id="nome_subcategoria" placeholder="Nome da subcategoria" tabindex="1">    
                </div>

                @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-12">
                <p style="text-align: center;">
                    <button type="submit" class="btn btn-lg btn-success btn-block" value="cadastrar" tabindex="3">
                        <a class="nav-link text-white">Cadastrar</a>
                    </button>
                </p>
            </div>
        </form>

        <div class="col-md-12 mx-auto justify-content-center align-items-center flex-column">
            <table id="table-categorias" class="table table-striped table-md">
                <div class="table-responsive">
                    <thead>
                    <tr>
                        <th>Nome da categoria</th>
                        <th>Tipo</th>
                        <th style='text-align:right;'>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class='fw-bold'>{{ $categoria->nome }}</td>
                            <td class='fw-bold'>{{ $categoria->tipo }}</td>
                            <td data-title="Ações" style='text-align:right;'>

                                <a href="{{ route('categoria.edit', ['id' => $categoria->id]) }}"><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>

                                <form action="{{ route('categoria.destroy', ['id' => $categoria->id]) }}" method="post"
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" value="excluir">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </div>
            </table>
            @if (count($categorias) == 0)
                <p style="text-align: center;"> Não existe categorias cadastrados no sistema</p>
            @endif
        </div>

    </div>

    <script>
        $(document).ready(function() {
            function toggleCheckbox(checkbox, otherCheckboxId) {
                var $otherCheckbox = $('#' + otherCheckboxId);
                var $selectContainer = $('#categoriaSelectContainer');
                var $formNameCategoria = $('.formNameCategoria');
                var $formNameSubcategoria = $('.formNameSubcategoria');

                if ($(checkbox).prop('checked')) {
                    $otherCheckbox.prop('disabled', true);

                    if (checkbox.id === 'cat') {
                        $formNameCategoria.removeClass('d-none');
                        $formNameSubcategoria.addClass('d-none');
                        $selectContainer.hide();
                        $('#id_pai').val(''); // Reset select value
                    } else if (checkbox.id === 'sub') {
                        $formNameSubcategoria.removeClass('d-none');
                        $formNameCategoria.addClass('d-none');
                        $selectContainer.show();
                    }
                } else {
                    $otherCheckbox.prop('disabled', false);
                    $formNameCategoria.addClass('d-none');
                    $formNameSubcategoria.addClass('d-none');
                    $selectContainer.hide();
                }
            }

            function toggleSelect() {
                var $select = $('#id_pai');
                var $formNameSubcategoria = $('.formNameSubcategoria');
                if ($select.val() !== '') {
                    $formNameSubcategoria.removeClass('d-none');
                } else {
                    $formNameSubcategoria.addClass('d-none');
                }
            }

            $('#cat').on('change', function() {
                toggleCheckbox(this, 'sub');
            });

            $('#sub').on('change', function() {
                toggleCheckbox(this, 'cat');
            });

            $('#id_pai').on('change', function() {
                toggleSelect();
            });
        });
    </script>
@endsection
@endauth
