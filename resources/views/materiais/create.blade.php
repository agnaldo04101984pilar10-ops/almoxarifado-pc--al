@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 max-w-2xl mx-auto">
    <h1 class="text-2xl font-black text-[#0B1437] uppercase mb-6">Cadastrar Novo Material</h1>

    <form action="{{ route('materiais.store') }}" method="POST">
        @csrf
        <div class="space-y-4">
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Nome do Material (Ex: Papel A4)</label>
                <input type="text" name="nome" required class="w-full border-gray-200 rounded-xl p-3 text-sm font-bold">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Unidade (Ex: UN, RESMA, CX)</label>
                    <input type="text" name="unidade" required class="w-full border-gray-200 rounded-xl p-3 text-sm font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Estoque Inicial</label>
                    <input type="number" name="estoque_atual" required class="w-full border-gray-200 rounded-xl p-3 text-sm font-bold">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Preço Unitário (Opcional)</label>
                <input type="number" step="0.01" name="preco_unitario" class="w-full border-gray-200 rounded-xl p-3 text-sm font-bold">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-4 rounded-2xl font-black uppercase shadow-lg hover:bg-blue-700 transition-all">
                Salvar Material no Banco
            </button>
        </div>
    </form>
</div>
@endsection