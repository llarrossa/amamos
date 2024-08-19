@extends("layouts.index")
@section("main")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-9">
            <div class="content mt-5">
                <p class="h5">Busca pelo grau de risco do medicamento</p>
                <div class="row mt-5">
                    <div class="col-12 col-md d-flex justify-content-center align-items-center mb-3 mb-md-0">
                        <form action="/buscar/risco" method="GET">
                            <input type="hidden" name="risco" value="CONTRAINDICADO">
                            <button type="submit" class="btn btn-danger btn-lg font-weight-bold">CONTRAINDICADO</button>
                        </form>
                    </div>
                    <div class="col-12 col-md d-flex justify-content-center align-items-center mb-3 mb-md-0">
                        <form action="/buscar/risco" method="GET">
                            <input type="hidden" name="risco" value="CRITERIOSO">
                            <button type="submit" class="btn btn-warning btn-lg font-weight-bold">CRITERIOSO</button>
                        </form>
                    </div>
                    <div class="col-12 col-md d-flex justify-content-center align-items-center">
                        <form action="/buscar/risco" method="GET">
                            <input type="hidden" name="risco" value="COMPATÍVEL">
                            <button type="submit" class="btn btn-success btn-lg font-weight-bold">COMPATÍVEL</button>
                        </form>
                    </div>
                </div>

                @if(request()->has('risco'))
                    @if($medicamentos->isNotEmpty())
                        <div class="row list-group mt-3" style="background-color: #fff;">
                            @foreach($medicamentos as $medicamento)
                                <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #bebebf;">
                                    <div class="d-flex flex-column flex-sm-row w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $medicamento->nome }}</h5>
                                        <small class="risco">{{ $medicamento->risco }}</small>
                                    </div>
                                    <p class="mb-1">{{ $medicamento->categoria->nome }}</p>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-5">Nenhum medicamento encontrado para o grau de risco selecionado.</p>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
