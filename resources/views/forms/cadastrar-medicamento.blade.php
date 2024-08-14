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
            <form action="{{-- route('store') --}}" method="post">

                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeMedicamento" name="nome" value="{{ old('nome') }}">
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}">
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria:</label>
                    <select class="form-select" name="categoria_id" tabindex="1" required>
                        <option selected>Selecione</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">
                                {{ $categoria->nome }}
                            </option>
                        @endforeach
                    </select>
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

            <div class="col-md-12 mx-auto justify-content-center align-items-center flex-column">
                <table id="table-medicamentos" class="table table-striped table-md">
                    <div class="table-responsive">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Risco</th>
                            <!--<th>Id</th>-->
                            <th style='text-align:right;'>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($medicamentos as $medicamento)
                            <tr>
                                <td class='fw-bold'>{{ $medicamento->nome }}</td>
                                <td class='fw-bold'>{{ $medicamento->categoria->nome }}</td>
                                <td class='fw-bold'>{{ $medicamento->risco }}</td>
                                <!--<td data-title='Id'> $medicamento)->id </td>-->
                                <td data-title="Ações" style='text-align:right;'>

                                    <a href='{{-- route("editcategoria", $medicamento)->id)--}} '><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>

                                    <form action="{{-- route('excluircategoria', $medicamento)->id) --}}" method="post"
                                          style="display:inline-block;">
                                        @csrf
                                        {{--@method('DELETE')--}}
                                        <button type="submit" class="btn btn-sm btn-danger" value="excluir">Excluir</button>
                                    </form>
                        @endforeach
                        </tbody>
                    </div>
                </table>
                @if (count($medicamentos) == 0)
                    <p style="text-align: center;"> Não existe medicamentos cadastrados no sistema</p>
                @endif
            </div>
        </div>
    </div>

@endsection
