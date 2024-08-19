<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::select('id', 'nome', 'id_pai', 'tipo')
            ->orderBy('nome')
            ->get();

        return view('forms.cadastrar-categoria', compact('categorias'));
    }

    public function store(Request $request)
    {
        $uniqueRule = 'unique:categorias,nome';
        if ($request->id) {
            $uniqueRule .= ',' . $request->id;
        }

        if($request->input('tipo') == 'cat'){
            $request->validate([
                'nomeCat' => ['required', 'max:150', $uniqueRule]
            ], [
                'nomeCat.unique' => 'Esse registro já existe'
            ]);

            Categoria::create([
                'nome' => $request->input('nomeCat'),
                'tipo' => $request->input('tipo'),
                'id_pai' => $request->input('id_pai')
            ]);
            
        }
        else if ($request->input('tipo') == 'sub') {
            $request->validate([
                'nomeSub' => ['required', 'max:150', $uniqueRule]
            ], [
                'nomeSub.unique' => 'Esse registro já existe',
            ]);

            Categoria::create([
                'nome' => $request->input('nomeSub'),
                'tipo' => $request->input('tipo'),
                'id_pai' => $request->input('id_pai')
            ]);
        }
        else {
            $request->validate([
                'tipo' => ['required']
            ], [
                'tipo.required' => 'Nenhuma opção selecionada',
            ]);
            return redirect()->route('categoria.index')->with('error', 'Ocorreu um erro');
        }

        return redirect()->route('categoria.index')->with('success', 'Categoria cadastrada com sucesso');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        $categorias = Categoria::select('id', 'nome', 'id_pai', 'tipo')
            ->orderBy('nome')
            ->get();

        return view('forms.editar-categoria', compact('categoria', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $uniqueRule = 'unique:categorias,nome';
        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        $request->validate([
            'nome' => ['required', 'max:150', $uniqueRule]
        ], [
            'nome.unique' => 'Esse registro já existe'
        ]);
        
        if ($categoria->tipo == 'cat') {
            $categoria->update(['nome' => $request->input('nome')]);
        }
        elseif ($categoria->tipo == 'sub') {
            $categoria->update(['nome' => $request->input('nome')]);
            $categoria->update(['id_pai' => $request->input('id_pai')]);
        }


        return redirect()
            ->route('categoria.index')
            ->with('success', 'Categoria atualizada com sucesso');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);

        if ($categoria->medicamentos()->exists()) {
            return redirect()
                ->route('categoria.index')
                ->withErrors('Não é possível excluir esta categoria, pois ela está associada a um ou mais medicamentos.');
        }

        $categoria->delete();

        return redirect()
            ->route('categoria.index')
            ->with('success', 'Categoria removida com sucesso.');
    }

    // private function validateCategoria(Request $request, $id = null)
    // {
    //     $uniqueRule = 'unique:categorias,nome';
    //     if ($id) {
    //         $uniqueRule .= ',' . $id;
    //     }

    //     $request->validate([
    //         'nomeCat' => ['required', 'max:150', $uniqueRule]
    //     ], [
    //         'nomeCat.unique' => 'Esse registro já existe',
    //     ]);
    // }
}
