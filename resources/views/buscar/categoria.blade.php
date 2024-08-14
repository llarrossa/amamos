@extends('layouts.index')

@section('main')
<div class="container">
    <form action="/buscar/categoria" method="GET">
        <p class="h5 mb-3">Buscar pela categoria do medicamento</p>
        <select class="form-select mb-3 w-75" name="categoria_id" required>
            <option selected>Selecione uma opção...</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @if(request()->has('categoria_id'))
        @if($medicamentos->isNotEmpty())
            <div class="list-group w-75 mt-3" style="background-color: #fff;">
                @foreach($medicamentos as $medicamento)
                      <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #bebebf;">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{ $medicamento->nome }}</h5>
                          <small class="risco">{{ $medicamento->risco }}</small>
                          <!-- <small>3 days ago</small> -->
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
@endsection
