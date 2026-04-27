<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Meus Pedidos Realizados') }}
            </h2>
            <a href="{{ route('pedidos.create') }}" style="background-color: #059669; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; text-decoration: none;">
                + Novo Pedido
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #22c55e;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full border-collapse" style="table-layout: auto; width: 100%;">
                        <thead>
                            <tr style="background-color: #f3f4f6; text-align: left;">
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Data</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Material</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Qtd</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">V. Unitário</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Total</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb;">Setor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pedidos as $pedido)
                                <tr style="text-align: left;">
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $pedido->material->descricao ?? 'N/A' }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $pedido->quantidade }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">R$ {{ number_format($pedido->valor_unitario, 2, ',', '.') }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $pedido->setor->nome ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="padding: 20px; text-align: center; color: #6b7280;">Nenhum pedido encontrado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>