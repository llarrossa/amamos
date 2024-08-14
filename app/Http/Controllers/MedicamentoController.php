<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicamentoController extends Controller
{
    public function index()
    {   

        $medicamentos = Medicamento::with('categoria')->orderBy('nome')->get();

        $categorias = DB::table('categorias')
            ->select('nome as nome', 'id as id')
            ->orderBy('nome')
            ->get();

        return view('forms.cadastrar-medicamento', ['categorias' => $categorias, 'medicamentos' => $medicamentos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'  => 'required|max:150|unique:categorias',
            'descricao' => 'max:300',
            'risco' => 'required'
        ],[
            'nome.unique'   => 'Esse registro já existe',
            'descricao.max' => 'A descrição deve conter no máximo 300 caracteres',
            'nome.required' => 'Esse campo é obrigatório'
        ]);

        try {
            $medicamento = new Medicamento($request->all());

            $medicamento->save();
            session()->flash('success', 'Medicamento cadastrada com sucesso');

            return redirect()->route('medicamento.index');
        } catch (QueryException $e) {
            flash()->error('Esse registro já existe');

            return redirect()->back();
        }


    }
}
