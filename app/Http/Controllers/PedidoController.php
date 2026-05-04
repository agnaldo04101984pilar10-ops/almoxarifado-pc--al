<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // IMPORTANTE: O 'use' deve ficar aqui no topo!

class PedidoController extends Controller
{
    // Lista todas as requisições
    public function index()
    {
        if (Auth::user()->tipo_usuario == 'admin') {
            $pedidos = Pedido::with(['user', 'material'])->orderBy('created_at', 'desc')->get();
        } else {
            $pedidos = Pedido::where('user_id', Auth::id())->with('material')->orderBy('created_at', 'desc')->get();
        }

        return view('pedidos.index', compact('pedidos'));
    }

    // Abre o formulário de nova requisição
    public function create()
    {
        $materiais = Material::where('estoque_atual', '>', 0)->orderBy('nome', 'asc')->get();
        return view('pedidos.create', compact('materiais'));
    }

    // Salva a lista de itens no banco de dados
    public function store(Request $request)
    {
        if (!$request->has('itens') || count($request->itens) == 0) {
            return back()->with('error', 'Adicione pelo menos um item na lista antes de enviar!');
        }

        try {
            DB::transaction(function () use ($request) {
                foreach ($request->itens as $item) {
                    $material = Material::findOrFail($item['material_id']);

                    Pedido::create([
                        'user_id'       => Auth::id(),
                        'material_id'   => $item['material_id'],
                        'setor_id'      => Auth::user()->setor_id,
                        'quantidade'    => $item['quantidade'],
                        'valor_unitario' => $material->preco_unitario ?? 0,
                        'valor_total'    => ($material->preco_unitario ?? 0) * $item['quantidade'],
                        'status'        => 'pendente',
                    ]);
                }
            });

            return redirect()->route('pedidos.index')->with('success', 'Requisição enviada com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao processar requisição: ' . $e->getMessage());
        }
    }

    // Função para o Admin dar baixa no estoque
    public function atender($id)
    {
        $pedido = Pedido::findOrFail($id);
        $material = Material::findOrFail($pedido->material_id);

        if ($material->estoque_atual < $pedido->quantidade) {
            return back()->with('error', 'Estoque insuficiente!');
        }

        DB::transaction(function () use ($pedido, $material) {
            $material->decrement('estoque_atual', $pedido->quantidade);
            $pedido->update(['status' => 'entregue']);
        });

        return back()->with('success', 'Item entregue e estoque atualizado!');
    } // <--- FECHAMENTO DA FUNÇÃO ATENDER

    // Gerar Comprovante PDF
    public function gerarPdf($id)
    {
        $pedido = Pedido::with(['user', 'material', 'setor'])->findOrFail($id);

        $pdf = Pdf::loadView('pedidos.pdf', compact('pedido'));
        
        return $pdf->stream('comprovante-' . $pedido->id . '.pdf');
    }
}