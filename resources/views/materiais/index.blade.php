@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#0B1437] uppercase">Materiais Cadastrados</h1>
            <p class="text-gray-400 text-sm font-bold tracking-tight">Gerenciamento de Itens do Almoxarifado</p>
        </div>
        <a href="{{ route('materiais.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-black uppercase text-[10px] shadow-lg shadow-blue-100 hover:bg-blue-700 transition-all">
            <i class="fa-solid fa-plus mr-2"></i>Novo Material
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-gray-100">
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Material</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase">Unidade</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase text-center">Estoque Atual</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase text-right">Preço Unit.</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materiais as $m)
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition-all">
                        <td class="py-4 text-sm font-bold text-[#0B1437]">{{ $m->nome }}</td>
                        <td class="py-4 text-xs text-gray-400 font-bold uppercase">{{ $m->unidade }}</td>
                        <td class="py-4 text-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black {{ $m->estoque_atual > 0 ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $m->estoque_atual }}
                            </span>
                        </td>
                        <td class="py-4 text-right text-sm font-bold text-gray-600">
                            R$ {{ number_format($m->preco_unitario, 2, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400 font-bold uppercase text-xs">
                            Nenhum material cadastrado ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection