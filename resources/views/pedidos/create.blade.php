@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Botão Voltar --}}
    <div class="mb-6">
        <a href="{{ route('materiais.index') }}" class="text-gray-400 hover:text-[#0B1437] font-black uppercase text-[10px] transition-all">
            <i class="fa-solid fa-arrow-left mr-2"></i>Voltar para a Lista
        </a>
    </div>

    <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
        <div class="mb-8">
            <h1 class="text-2xl font-black text-[#0B1437] uppercase">Cadastrar Novo Material</h1>
            <p class="text-gray-400 text-sm font-bold">Preencha as informações abaixo para adicionar o item ao estoque.</p>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-xl">
                <ul class="list-disc list-inside text-red-600 text-xs font-bold uppercase">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materiais.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                
                {{-- Linha 1: Nome e Código SIAP --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Descrição / Nome do Material</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" required 
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:bg-white focus:border-blue-500 transition-all outline-none" 
                               placeholder="Ex: PAPEL A4 75G">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Código SIAP</label>
                        <input type="text" name="codigo_siap" value="{{ old('codigo_siap') }}" required 
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:bg-white focus:border-blue-500 transition-all outline-none" 
                               placeholder="Ex: 123456">
                    </div>
                </div>

                {{-- Linha 2: Unidade, Estoque e Preço --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Unidade de Medida</label>
                        <input type="text" name="unidade" value="{{ old('unidade') }}" required 
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:bg-white focus:border-blue-500 transition-all outline-none" 
                               placeholder="Ex: UN, CX, RESMA">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Estoque Inicial</label>
                        <input type="number" name="estoque_atual" value="{{ old('estoque_atual', 0) }}" required 
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:bg-white focus:border-blue-500 transition-all outline-none">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Preço Unitário (R$)</label>
                        <input type="number" step="0.01" name="preco_unitario" value="{{ old('preco_unitario') }}" 
                               class="w-full bg-gray-50 border border-gray-100 rounded-2xl p-4 text-sm font-bold text-[#0B1437] focus:bg-white focus:border-blue-500 transition-all outline-none" 
                               placeholder="0,00">
                    </div>
                </div>

                {{-- Botão de Ação --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#0B1437] hover:bg-blue-600 text-white p-5 rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl shadow-blue-900/10">
                        Finalizar Cadastro do Material
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection