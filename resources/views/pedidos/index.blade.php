@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-[32px] shadow-sm border border-gray-100">
        <div>
            <h3 class="text-xl font-black text-[#0B1437] uppercase">Gerenciar Requisições</h3>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Acompanhamento de pedidos por setor</p>
        </div>
        <a href="{{ route('pedidos.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-xs transition shadow-lg shadow-blue-600/20 uppercase tracking-widest">
            Nova Requisição
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-xl font-bold text-sm shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">ID</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Data</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Solicitante / Setor</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($pedidos as $pedido)
                <tr class="hover:bg-gray-50/50 transition duration-200">
                    <td class="px-6 py-4 font-black text-[#0B1437]">#{{ $pedido->id }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4">
                        <p class="text-sm font-bold text-[#0B1437]">{{ $pedido->user->name }}</p>
                        <p class="text-[10px] text-blue-500 font-bold uppercase">{{ $pedido->setor }}</p>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($pedido->status == 'Pendente')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-600 rounded-full text-[9px] font-black uppercase tracking-tighter">Aguardando</span>
                        @elseif($pedido->status == 'Aprovada')
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-[9px] font-black uppercase tracking-tighter">Aprovada</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-[9px] font-black uppercase tracking-tighter">{{ $pedido->status }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($pedido->status == 'Pendente')
                            <a href="{{ route('pedidos.analise', $pedido->id) }}" class="inline-flex items-center space-x-2 bg-[#0B1437] hover:bg-blue-900 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition">
                                <i class="fa-solid fa-magnifying-glass-chart"></i>
                                <span>Analisar</span>
                            </a>
                        @else
                            <button disabled class="text-gray-300 font-bold text-[10px] uppercase tracking-widest">Processado</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fa-solid fa-inbox text-gray-100 text-6xl mb-4"></i>
                            <p class="text-gray-400 font-bold">Nenhuma requisição no momento.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection