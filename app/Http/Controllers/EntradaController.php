<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntradaController extends Controller
{
    public function create()
    {
        $materiais = Material::orderBy('nome', 'asc')->get();
        return view('entradas.create', compact('materiais'));
    }

    public function store(Request $request)
{
    $request->validate([
        'material_id' => 'required|exists:materials,id',
        'quantidade' => 'required|integer|min:1',
        'documento' => 'nullable|string',
    ]);

    \DB::transaction(function () use ($request) {
        // Pegamos apenas os campos necessários, ignorando o _token
        $dados = $request->only(['material_id', 'quantidade', 'documento', 'fornecedor']);
        
        Entrada::create($dados);

        $material = Material::find($request->material_id);
        $material->increment('estoque_atual', $request->quantidade);
    });

    return redirect()->route('estoque.index')->with('success', 'Estoque atualizado com sucesso!');
}
}