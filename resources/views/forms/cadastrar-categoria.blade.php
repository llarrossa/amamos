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
        <form class="row g-2" action="{{ route('categoria.store') }}" method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="col-12">
                <label for="nome" class="form-label">Categoria:</label>
                <input type="text" class="form-control @error('nome') is-invalid @enderror" name="nome" placeholder="Nome da categoria" tabindex="1">

                @error('nome')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="col-12">
                <p style="text-align: right;">
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
                        <!--<th>Id</th>-->
                        <th style='text-align:right;'>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class='fw-bold'>{{ $categoria->nome }}</td>
                            <!--<td data-title='Id'> $categoria->id </td>-->
                            <td data-title="Ações" style='text-align:right;'>

                                <a href='{{-- route("editcategoria", $categoria->id)--}} '><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>

                                <form action="{{-- route('excluircategoria', $categoria->id) --}}" method="post"
                                      style="display:inline-block;">
                                    @csrf
                                    {{--@method('DELETE')--}}
                                    <button type="submit" class="btn btn-sm btn-danger" value="excluir">Excluir</button>
                                </form>
                    @endforeach
                    </tbody>
                </div>
            </table>
            @if (count($categorias) == 0)
                <p style="text-align: center;"> Não existe categorias cadastrados no sistema</p>
            @endif
        </div>


    </div>
@endsection
@endauth