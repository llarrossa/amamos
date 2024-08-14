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
            ->select('nome as nome')
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

    public function destroy(Request $request)
    {

    }
}
