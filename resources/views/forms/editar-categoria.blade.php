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

        <div class="col-md-8  mx-auto justify-content-center align-items-center flex-column">
            <form class="row g-2" action="{{ route('categoria.update', ['id' => $categoria['id']]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="col-12">
                    <label for="nome" class="form-label"><h4>Edite o nome da categoria</h4></label>
                    <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome da categoria" tabindex="1" value="{{ $categoria['nome'] }}">
                    @error('nome')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                    @if($categoria['tipo'] === 'sub')
                        <div id="categoriaSelectContainer" class="mt-5">
                            <label for="id_pai" class="form-label"><h4>Selecione a categoria relacionada:</h4></label>
                            <select name="id_pai" id="id_pai" class="form-select mb-3">
                                <option value="">Selecione uma Categoria</option>
                                @foreach ($categorias as $cat)
                                    @if ($cat['tipo'] === 'cat' && $cat['id_pai'] === null)
                                        <option value="{{ $cat['id'] }}" 
                                            @if($cat['id'] == $categoria['id_pai']) selected @endif>
                                            {{ $cat['nome'] }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>

                <div class="col-12">
                    <p style="text-align: center;">
                        <button type="submit" class="btn btn-lg btn-success btn-block" value="atualizar" tabindex="3">
                            Atualizar
                        </button>
                    </p>
                </div>
            </form>

{{--            <div class="col-md-12 mx-auto justify-content-center align-items-center flex-column">--}}
{{--                <table id="table-categorias" class="table table-striped table-md">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Nome da categoria</th>--}}
{{--                            <!--<th>Id</th>-->--}}
{{--                            <th style='text-align:right;'>Ações</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach ($categorias as $categoria)--}}
{{--                            <tr>--}}
{{--                                <td class='fw-bold'>{{ $categoria->nome }}</td>--}}
{{--                                <!--<td data-title='Id'> $categoria->id </td>-->--}}
{{--                                <td data-title="Ações" style='text-align:right;'>--}}

{{--                                    <a  href='{{ route("categoria.edit", ["id" => $categoria->id]) }}'><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>--}}

{{--                                    <form action="--}}{{-- route('excluircategoria', $categoria->id) --}}{{--" method="post"--}}
{{--                                          style="display:inline-block;">--}}
{{--                                        @csrf--}}
{{--                                        --}}{{--@method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-sm btn-danger" value="excluir">Excluir</button>--}}
{{--                                    </form>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </div>--}}
{{--                </table>--}}
{{--                @if (count($categorias) == 0)--}}
{{--                    <p style="text-align: center;"> Não existe categorias cadastrados no sistema</p>--}}
{{--                @endif--}}
{{--            </div>--}}


        </div>
    @endsection
@endauth
