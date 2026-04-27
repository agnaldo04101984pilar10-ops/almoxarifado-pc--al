<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Pedido;
use App\Models\Setor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index()
{
    $totalMateriais = Material::count();
    $estoqueBaixo = Material::where('estoque_atual', '<', 10)->get();
    $gastoMes = Pedido::whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year)
                      ->sum('valor_total');

    // Pegamos os 5 setores que mais gastaram para o gráfico
    $gastosPorSetor = Setor::withSum(['pedidos' => function($query) {
        $query->whereMonth('created_at', now()->month);
    }], 'valor_total')->get();

    // Preparando dados para o gráfico (Nomes e Valores)
    $labels = $gastosPorSetor->pluck('nome')->toArray();
    $valores = $gastosPorSetor->pluck('pedidos_sum_valor_total')->map(fn($v) => $v ?? 0)->toArray();

    return view('dashboard', compact('totalMateriais', 'estoqueBaixo', 'gastoMes', 'gastosPorSetor', 'labels', 'valores'));
}
}