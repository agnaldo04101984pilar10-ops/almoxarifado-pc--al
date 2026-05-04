<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    // Lista todos os materiais cadastrados
    public function index() {
        $materiais = Material::orderBy('nome', 'asc')->get();
        return view('materiais.index', compact('materiais'));
    }

    // Abre a tela de cadastro
    public function create() {
        return view('materiais.create');
    }

    // Salva o novo material no banco
   public function store(Request $request) {
    $request->validate([
        'nome' => 'required|unique:materials',
        'codigo_siap' => 'required',
        'unidade' => 'required', // Nome que vem do formulário
        'estoque_atual' => 'required|integer',
    ]);

    // Pegamos todos os dados do formulário
    $dados = $request->all();
    
    // IMPORTANTE: Aqui dizemos que o valor de 'unidade' vai para 'unidade_medida'
    $dados['unidade_medida'] = $request->unidade;

    Material::create($dados);

    return redirect()->route('materiais.index')->with('success', 'Material cadastrado com sucesso!');
}
}