<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Material;
use App\Models\Setor;
use Illuminate\Support\Facades\DB; 

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with(['material', 'user', 'setor'])->latest()->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $materiais = Material::all();
        return view('pedidos.create', compact('materiais'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Garante que o usuário tenha setor
        if (!$user->setor_id) {
            $primeiroSetor = Setor::first();
            if (!$primeiroSetor) {
                return redirect()->back()->with('error', 'Cadastre um Setor primeiro!');
            }
            $user->update(['setor_id' => $primeiroSetor->id]);
        }

        $material = Material::findOrFail($request->material_id);
        
        // Verifica estoque antes de tudo
        if ($material->estoque_atual < $request->quantidade) {
            return redirect()->back()->with('error', "Estoque insuficiente! Temos apenas {$material->estoque_atual} unidades.");
        }

        $preco = $material->preco ?? $material->preco_unitario ?? 0;
        $valorTotal = $preco * $request->quantidade;

        try {
            // O DB::transaction agora vai funcionar porque importamos lá no topo
            DB::transaction(function () use ($user, $material, $request, $preco, $valorTotal) {
                
                // Cria o pedido
                Pedido::create([
                    'user_id' => $user->id,
                    'material_id' => $material->id,
                    'setor_id' => $user->setor_id,
                    'quantidade' => $request->quantidade,
                    'valor_unitario' => $preco,
                    'valor_total' => $valorTotal,
                ]);

                // Baixa no estoque
                $material->decrement('estoque_atual', $request->quantidade);
            });

            return redirect()->route('pedidos.index')->with('success', 'Pedido realizado com sucesso!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao processar pedido: ' . $e->getMessage());
        }
    }
}