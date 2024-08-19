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
            ->select('id as id', 'nome as nome', 'tipo as tipo', 'id_pai as id_pai')
            ->orderBy('nome')
            ->get();

        return view('forms.cadastrar-medicamento', ['categorias' => $categorias, 'medicamentos' => $medicamentos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'  => 'required|max:150',
            'descricao' => 'max:500',
            'risco' => 'required',
            'categoria' => 'required|max:150'
        ],[
            'descricao.max' => 'A descrição deve conter no máximo 500 caracteres',
            'nome.required' => 'Esse campo é obrigatório',
            'risco.required' => 'Esse campo é obrigatório',
            'categoria.required' => 'Esse campo é obrigatório',
            'categoria.max' => 'Esse campo deve conter até 150 caracteres'
        ]);

        Medicamento::create([
            'nome' => $request->input('nome'),
            'descricao' => $request->input('descricao'),
            'risco' => $request->input('risco'),
            'categoria_id' => $request->input('categoria_id') ?? $request->input('categoria')
        ]);

        return redirect()->route('medicamento.index')->with('success', 'Medicamento cadastrado com sucesso');

        // try {
        //     $medicamento = new Medicamento($request->all());

        //     $medicamento->save();
        //     session()->flash('success', 'Medicamento cadastrada com sucesso');

        //     return redirect()->route('medicamento.index');
        // } catch (QueryException $e) {
        //     flash()->error('Esse registro já existe');

        //     return redirect()->back();
        // }
    }

    public function edit($id) 
    {
        $medicamento = Medicamento::findOrFail($id);

        // dd($medicamento);

        $categorias = Categoria::select('id', 'nome', 'id_pai', 'tipo')
            ->orderBy('nome')
            ->get();

        return view('forms.editar-medicamento', compact('medicamento', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $request->validate([
            'nome'  => 'required|max:150',
            'descricao' => 'max:500',
            'risco' => 'required'
        ], [
            'nome.required' => 'Esse campo é obrigatório',
            'descricao.max' => 'A descrição deve conter no máximo 500 caracteres',
            'risco.required' => 'Esse campo é obrigatório'
        ]);

        $medicamento->update(['nome' => $request->input('nome')]);
        $medicamento->update(['descricao' => $request->input('descricao')]);
        $medicamento->update(['risco' => $request->input('risco')]);

        return redirect()->route('medicamento.index')->with('success', 'Medicamento atualizado com sucesso');
    }

    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);

        $medicamento->delete();

        return redirect()->route('medicamento.index')->with('success', 'Medicamento removido com sucesso');
    }

    public function getSubcategorias($id)
    {
        $subcategorias = Categoria::where('id_pai', $id)->get(['id', 'nome']);
        return response()->json($subcategorias);
    }
}
