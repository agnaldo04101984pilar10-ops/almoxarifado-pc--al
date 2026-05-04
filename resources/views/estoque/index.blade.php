@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#0B1437] uppercase">Controle de Estoque</h1>
            <p class="text-gray-400 text-sm font-bold">Visualize o saldo atual de todos os itens cadastrados.</p>
        </div>
        <a href="{{ route('entradas.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl text-xs font-black uppercase transition-all shadow-lg shadow-blue-200">
            + Registrar Entrada
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="border-b border-gray-100">
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">SIAP</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Material</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Unidade</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Saldo Atual</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materiais as $material)
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-all">
                    <td class="py-4 text-xs font-bold text-gray-500">{{ $material->codigo_siap }}</td>
                    <td class="py-4 text-sm font-black text-[#0B1437] uppercase">{{ $material->nome }}</td>
                    <td class="py-4 text-xs font-bold text-gray-400 uppercase">{{ $material->unidade_medida }}</td>
                    <td class="py-4">
                        <span class="text-sm font-black {{ $material->estoque_atual < 10 ? 'text-red-500' : 'text-[#0B1437]' }}">
                            {{ $material->estoque_atual }}
                        </span>
                    </td>
                    <td class="py-4">
                        @if($material->estoque_atual <= 0)
                            <span class="bg-red-100 text-red-600 text-[9px] font-black px-2 py-1 rounded-lg uppercase">Esgotado</span>
                        @elseif($material->estoque_atual < 10)
                            <span class="bg-orange-100 text-orange-600 text-[9px] font-black px-2 py-1 rounded-lg uppercase">Estoque Baixo</span>
                        @else
                            <span class="bg-green-100 text-green-600 text-[9px] font-black px-2 py-1 rounded-lg uppercase">Em Dia</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-400 font-bold italic">
                        Nenhum material encontrado no estoque.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection