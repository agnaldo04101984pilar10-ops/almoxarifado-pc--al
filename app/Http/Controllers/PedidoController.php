<?php

namespace App\Http\Controllers;

use App\Models\Requisicao;
use App\Models\ItemRequisicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function index()
    {
        // Carrega os pedidos com as relações para mostrar na tabela
        $pedidos = Requisicao::with('user')->orderBy('created_at', 'desc')->get();
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        return view('pedidos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'materiais' => 'required|array',
            'quantidades' => 'required|array',
        ]);

        try {
            DB::beginTransaction();

            $requisicao = Requisicao::create([
                'user_id' => Auth::id(),
                'setor' => Auth::user()->setor,
                'status' => 'Pendente',
            ]);

            foreach ($request->materiais as $index => $material_id) {
                ItemRequisicao::create([
                    'requisicao_id' => $requisicao->id,
                    'material_id' => $material_id,
                    'quantidade_solicitada' => $request->quantidades[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('pedidos.index')->with('success', 'Requisição enviada com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao salvar: ' . $e->getMessage());
        }
    }

    // --- OS MÉTODOS QUE VOCÊ PEDIU PARA ADICIONAR ---

    public function analise($id)
    {
        // Busca o pedido com os itens, o material de cada item e o usuário que pediu
        $pedido = Requisicao::with('itens.material', 'user')->findOrFail($id);
        return view('pedidos.analise', compact('pedido'));
    }

    public function aprovar(Request $request, $id)
    {
        $pedido = Requisicao::findOrFail($id);
        
        foreach ($request->itens as $item_id => $dados) {
            $item = ItemRequisicao::findOrFail($item_id);
            $qtd_atendida = $dados['quantidade_atendida'];

            // REGRA 5: Nunca maior que o solicitado (Validação de Segurança)
            if ($qtd_atendida > $item->quantidade_solicitada) {
                return back()->with('error', "Erro: A quantidade atendida do item {$item->material->nome} não pode ser maior que a solicitada.");
            }

            $item->update(['quantidade_atendida' => $qtd_atendida]);
        }

        $pedido->update(['status' => 'Aprovada']);

        return redirect()->route('pedidos.index')->with('success', 'Requisição aprovada e quantidades ajustadas!');
    }
}