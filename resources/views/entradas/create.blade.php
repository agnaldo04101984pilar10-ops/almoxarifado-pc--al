@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-[#0B1437] uppercase">Nova Entrada de Material</h1>
            <p class="text-gray-400 text-sm font-bold">Use este formulário para alimentar o estoque com novos itens.</p>
        </div>

        <form action="{{ route('entradas.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                {{-- Seleção do Material --}}
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Selecione o Material</label>
                    <select name="material_id" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:border-blue-500 outline-none">
                        <option value="">Clique para selecionar...</option>
                        @foreach($materiais as $m)
                            <option value="{{ $m->id }}">{{ $m->nome }} (Atual: {{ $m->estoque_atual }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Quantidade --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Quantidade a Adicionar</label>
                        <input type="number" name="quantidade" min="1" required class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437]">
                    </div>
                    
                    {{-- Documento --}}
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Nota Fiscal / Processo</label>
                        <input type="text" name="documento" class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437]" placeholder="Ex: NF 102030">
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white p-5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-green-900/10">
                    Confirmar Entrada e Somar ao Estoque
                </button>
            </div>
        </form>
    </div>
</div>
@endsection