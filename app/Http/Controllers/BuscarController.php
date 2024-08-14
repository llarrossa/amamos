<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuscarController extends Controller
{
    public function buscarPorCategoria(Request $request)
    {
        // Buscando todas as categorias no banco de dados
        $categorias = Categoria::all();

        // Inicializando a coleção de medicamentos como vazia
        $medicamentos = collect();

        // Verificando se uma categoria foi selecionada
        if ($request->has('categoria_id') && $request->categoria_id != 'Selecione uma opção...') {
            // Buscando os medicamentos pela categoria selecionada
            $medicamentos = Medicamento::where('categoria_id', $request->categoria_id)
                                        ->select('nome', 'descricao', 'risco') // Seleciona apenas as colunas necessárias
                                        ->get();
        }

        return view('buscar.categoria', compact('categorias', 'medicamentos'));
    }

    public function buscarPorNome(Request $request)
    {
        // Inicializando a coleção de medicamentos como vazia
        $medicamentos = collect();

        // Verificando se um nome foi fornecido na busca
        if ($request->has('nome') && !empty($request->nome)) {
            // Buscando os medicamentos pelo nome fornecido e carregando a relação com a categoria
            $medicamentos = Medicamento::where('nome', 'like', '%' . $request->nome . '%')
                ->with('categoria:id,nome') // Carregando a relação 'categoria' e selecionando apenas os campos 'id' e 'nome'
                ->get(['nome', 'descricao', 'risco', 'categoria_id']); // Selecionando os campos do modelo Medicamento
        }

        return view('buscar.nome', compact('medicamentos'));
    }

   public function buscarPorRisco(Request $request)
   {
       // Inicializando a coleção de medicamentos como vazia
       $medicamentos = collect();

       // Verificando se um grau de risco foi selecionado
       if ($request->has('risco')) {
           // Buscando os medicamentos pelo grau de risco selecionado
           $medicamentos = Medicamento::where('risco', $request->risco)->get();
       }

       return view('buscar.risco', compact('medicamentos'));
   }

}
