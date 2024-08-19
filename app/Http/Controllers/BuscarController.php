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

        $categoria = $request->input('categoria_id') ?? $request->input('categoria');

        // var_dump($categoria);die();

        // Verificando se uma categoria foi selecionada
        // if ($request->has('categoria_id') && $request->categoria_id != 'Selecione uma opção...') {
            // Buscando os medicamentos pela categoria selecionada
            $medicamentos = Medicamento::where('categoria_id', $categoria)
                                        ->select('nome', 'descricao', 'risco') // Seleciona apenas as colunas necessárias
                                        ->get();
        // }

        return view('buscar.categoria', compact('categorias', 'medicamentos'));
    }

    public function buscarPorNome(Request $request)
    {
        // Inicializando a coleção de medicamentos como vazia
        $medicamentos = collect();

        if ($request->has('nome') && !empty($request->nome)) {
            $medicamentos = Medicamento::where('nome', 'like', '%' . $request->nome . '%')
                ->with('categoria:id,nome,id_pai')  // Incluir id_pai
                ->get(['nome', 'descricao', 'risco', 'categoria_id']);
        }

        // Processar os medicamentos para buscar a categoria pai, se tiver
        $medicamentos = $medicamentos->map(function ($medicamento) {
            $categoria = Categoria::find($medicamento->categoria_id);

            if ($categoria && $categoria->id_pai) {
                $categoriaPai = Categoria::find($categoria->id_pai);
                if ($categoriaPai) {
                    $medicamento->categoria_pai_nome = $categoriaPai->nome;
                }
            } else {
                $medicamento->categoria_pai_nome = null;
            }

            return $medicamento;
        });

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
