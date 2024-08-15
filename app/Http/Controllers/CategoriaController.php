<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = DB::table('categorias')
            ->select('id', 'nome as nome')
            ->orderBy('nome')
            ->get();

        return view('forms.cadastrar-categoria', ['categorias' => $categorias]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:150|unique:categorias'
        ],  [
            'nome.unique' => 'Esse registro já existe',
        ]);

        try {
            $categoria = new Categoria();

            $categoria->nome = $request->input('nome');

            $categoria->save();

            session()->flash('success', 'Categoria cadastrada com sucesso');

            return redirect()->route('categoria.index');
        } catch (QueryException $e) {
            flash()->error('Esse registro já existe');
            return redirect()->back();
        }


    }

    public function edit($id)
    {
        // Busca a categoria pelo ID
        $categoria = Categoria::findOrFail($id);

        $categoria = ['id' => $categoria->id, 'nome' => $categoria->nome];

        // Retorna a view de edição com os dados da categoria
        return view('forms.editar-categoria', ['categoria' => $categoria]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:150|unique:categorias'
        ],  [
            'nome.unique' => 'Esse registro já existe',
        ]);

        // Busca a categoria pelo ID
        $categoria = Categoria::findOrFail($id);

        // Atualiza os dados da categoria
        $categoria->nome = $request->nome;
        $categoria->save();

        // Redireciona para a lista de categorias com uma mensagem de sucesso
        return redirect()->route('categoria.index');
    }

    public function destroy(Request $request)
    {

    }
}
