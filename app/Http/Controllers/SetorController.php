<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setor;

class SetorController extends Controller
{
    public function index()
    {
        $setores = Setor::all();
        return view('setores.index', compact('setores'));
    }

    public function create()
    {
        return view('setores.create');
    }

    public function store(Request $request)
    {
        Setor::create([
            'nome' => $request->nome,
            'limite_mensal' => $request->limite_mensal,
        ]);

        return redirect()->route('setores.index')->with('success', 'Setor criado com sucesso!');
    }

    public function edit($id)
    {
        $setor = Setor::findOrFail($id);
        return view('setores.edit', compact('setor'));
    }

    public function update(Request $request, $id)
    {
        $setor = Setor::findOrFail($id);
        $setor->update([
            'nome' => $request->nome,
            'limite_mensal' => $request->limite_mensal,
        ]);

        return redirect()->route('setores.index')->with('success', 'Setor atualizado!');
    }

    public function destroy($id)
    {
        $setor = Setor::findOrFail($id);
        
        // Verifica se existem pedidos vinculados antes de excluir (opcional)
        $setor->delete();

        return redirect()->route('setores.index')->with('success', 'Setor excluído!');
    }
}