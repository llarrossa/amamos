@extends('layouts.index')

@section('main')
<div class="container">
    <form action="/buscar/nome" method="GET">
        <p class="h5 mb-3">Buscar pelo nome do medicamento</p>
        <!-- <label class="mb-3" for="nome">Nome do Medicamento</label> -->
        <!-- <div class=""> -->
            <input class="form-control mb-3 w-75" type="text" id="nome" name="nome" placeholder="Digite o nome do medicamento">
            <!-- <input type="text" class="form-control mb-3" id="nome" name="nome" placeholder="Digite o nome do medicamento"> -->
        <button type="submit" class="btn btn-primary">Buscar</button>
        <!-- </div> -->
    </form>

    <!-- @if(request()->has('nome'))
        @if($medicamentos->isNotEmpty())
            <h2>Resultados da Busca</h2>
            <table id="medicamentos-table" class="display table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Risco</th>
                        <th>Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicamentos as $medicamento)
                        <tr>
                            <td>{{ $medicamento->nome }}</td>
                            <td>{{ $medicamento->risco }}</td>
                            <td>{{ $medicamento->categoria->nome }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Nenhum medicamento encontrado.</p>
        @endif
    @endif -->

    @if(request()->has('nome'))
        @if($medicamentos->isNotEmpty())
            <div class="list-group w-75 mt-3" style="background-color: #fff;">
                @foreach($medicamentos as $medicamento)
                      <a href="#" class="list-group-item list-group-item-action" aria-current="true" style="background-color: #bebebf;">
                        <div class="d-flex w-100 justify-content-between">
                          <h5 class="mb-1">{{ $medicamento->nome }}</h5>
                          <small class="risco">{{ $medicamento->risco }}</small>
                          <!-- <small>3 days ago</small> -->
                        </div>
                        <p class="mb-1">{{ $medicamento->categoria->nome }}</p>
                      </a>
                @endforeach
            </div>
        @else
            <p>Nenhum medicamento encontrado.</p>
        @endif
    @endif
</div>

<!-- DataTables Initialization Script -->
<!-- <script>
$(document).ready(function() {
    $('#medicamentos-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Portuguese-Brasil.json"
        }
    });
});
</script> -->
@endsection
