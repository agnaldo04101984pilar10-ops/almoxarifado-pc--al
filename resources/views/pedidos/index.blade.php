@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#0B1437] uppercase">Requisições de Materiais</h1>
            <p class="text-gray-400 text-sm font-bold tracking-tight">Gerenciamento de solicitações das unidades</p>
        </div>
        @if(Auth::user()->tipo_usuario != 'admin')
        <a href="{{ route('pedidos.create') }}" class="bg-blue-600 hover:bg-[#0B1437] text-white px-6 py-3 rounded-2xl text-xs font-black uppercase transition-all shadow-lg shadow-blue-100 flex items-center gap-2">
            <i class="fa-solid fa-plus">Nova Requisição</i>
        </a>
        @endif
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-2xl text-xs font-black uppercase border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-gray-50">
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Unidade/Solicitante</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Material</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Qtd</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $p)
                <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-all">
                    <td class="py-5">
                        <div class="font-bold text-[#0B1437]">{{ $p->user->setor }}</div>
                        <div class="text-[10px] text-gray-400 uppercase font-black">{{ $p->user->name }}</div>
                    </td>
                    <td class="py-5">
                        <div class="text-sm font-bold text-gray-700">{{ $p->material_nome }}</div>
                    </td>
                    <td class="py-5 text-sm font-black text-blue-600">
                        {{ $p->quantidade }}
                    </td>
                    <td class="py-5">
                        @if($p->status == 'pendente')
                            <span class="bg-orange-50 text-orange-500 px-3 py-1 rounded-lg text-[10px] font-black uppercase animate-pulse">Pendente</span>
                        @else
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Entregue</span>
                        @endif
                    </td>
                    <td class="py-5 text-right">
                        @if(Auth::user()->tipo_usuario == 'admin' && $p->status == 'pendente')
                        <form action="{{ route('pedidos.atender', $p->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase transition-all shadow-md">
                                Baixar no Estoque
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center text-gray-400 uppercase text-xs font-black">Nenhuma requisição encontrada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection