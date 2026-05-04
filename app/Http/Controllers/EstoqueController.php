<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        // Puxa todos os materiais ordenados por nome
        $materiais = Material::orderBy('nome', 'asc')->get();

        // Passa para a view (que vamos criar abaixo)
        return view('estoque.index', compact('materiais'));
    }
}