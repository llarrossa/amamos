@extends('layouts.index')

@section('main')
<div class="container">
    <form action="/buscar/nome" method="GET">
        <p class="h5 mb-3">Buscar pelo nome do medicamento</p>
        <input class="form-control mb-3 w-75" type="text" id="nome" name="nome" placeholder="Digite o nome do medicamento" required>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if(request()->has('nome'))
        @if($medicamentos->isNotEmpty())
            <div class="row col-12 col-md-9 list-group mt-3" style="background-color: #fff;">
                @foreach($medicamentos as $medicamento)
                    <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #bebebf;">
                        <div class="d-flex w-100 justify-content-between flex-column flex-sm-row">
                            <h5 class="mb-1">{{ $medicamento->nome }}</h5>
                            <small class="risco">{{ $medicamento->risco }}</small>
                        </div>
                        <p class="mb-1">
                            {{ $medicamento->categoria->nome }}
                            @if($medicamento->categoria_pai_nome)
                                ({{ $medicamento->categoria_pai_nome }})
                            @endif
                        </p>
                        @if($medicamento->descricao)
                        <p class="mb-1">{{ $medicamento->descricao }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <p>Nenhum medicamento encontrado.</p>
        @endif
    @endif
</div>
@endsection
