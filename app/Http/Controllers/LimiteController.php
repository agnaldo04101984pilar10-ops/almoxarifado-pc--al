<?php

namespace App\Http\Controllers;

use App\Models\LimiteMensal;
use App\Models\Material;
use Illuminate\Http\Request;

class LimiteController extends Controller
{
    public function index()
    {
        $limites = LimiteMensal::with('material')->get();
        $materials = Material::all();
        // Lista de setores fixa para facilitar, ou você pode buscar do banco
        $setores = ['IML - Maceió', 'IML - Arapiraca', 'IC - Maceió', 'IC - Arapiraca', 'Anotomia'];
        
        return view('limites.index', compact('limites', 'materials', 'setores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'setor' => 'required',
            'material_id' => 'required',
            'quantidade_limite' => 'required|integer'
        ]);

        LimiteMensal::updateOrCreate(
            ['setor' => $request->setor, 'material_id' => $request->material_id],
            ['quantidade_limite' => $request->quantidade_limite]
        );

        return back()->with('success', 'Limite definido com sucesso!');
    }
}