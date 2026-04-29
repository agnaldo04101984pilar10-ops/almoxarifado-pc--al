<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MaterialController extends Controller
{
    public function index()
    {
        // Pega todos os materiais do banco
        $materials = Material::orderBy('nome', 'asc')->get();
        return view('materials.index', compact('materials'));
    }

    public function store(Request $request)
    {
        // Validação obrigatória para não dar erro de SQL
        $request->validate([
            'nome' => 'required',
            'codigo_siap' => 'required',
            'unidade_medida' => 'required',
        ]);

        // Cria o material com os dados do formulário
        Material::create([
            'nome' => $request->nome,
            'codigo_siap' => $request->codigo_siap,
            'unidade_medida' => $request->unidade_medida,
            'estoque_atual' => $request->estoque_atual ?? 0,
        ]);

        return redirect()->route('materials.index')->with('success', 'Material cadastrado!');
    }

    public function destroy($id)
    {
        if (Gate::allows('admin-central')) {
            Material::findOrFail($id)->delete();
        }
        return redirect()->route('materials.index');
    }
}