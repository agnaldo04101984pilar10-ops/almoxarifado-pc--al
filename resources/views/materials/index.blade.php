@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center bg-white p-6 rounded-[32px] shadow-sm border border-gray-100">
        <div>
            <h3 class="text-xl font-black text-[#0B1437] uppercase">Catálogo de Materiais</h3>
            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest">Almoxarifado Polícia Científica</p>
        </div>
        
        @can('admin-central')
        <button onclick="document.getElementById('modal-material').classList.toggle('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl font-bold text-xs transition shadow-lg uppercase tracking-widest">
            Cadastrar Novo Item
        </button>
        @endcan
    </div>

    <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Cód. SIAP</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Descrição</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Unidade</th>
                    <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-center">Estoque</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($materials ?? [] as $material)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 font-black text-blue-600">#{{ $material->codigo_siap }}</td>
                    <td class="px-6 py-4 text-sm font-bold text-[#0B1437] uppercase">{{ $material->nome }}</td>
                    <td class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">{{ $material->unidade_medida }}</td>
                    <td class="px-6 py-4 text-center font-bold text-[#0B1437]">{{ $material->estoque_atual }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-gray-400 font-bold uppercase text-xs">Nenhum material cadastrado</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div id="modal-material" class="hidden fixed inset-0 bg-[#0B1437]/80 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-md rounded-[32px] p-8 shadow-2xl border border-white/20">
        <h3 class="text-xl font-black text-[#0B1437] mb-6 uppercase">Novo Material</h3>
        <form action="{{ route('materials.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Código SIAP</label>
                <input type="text" name="codigo_siap" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Descrição</label>
                <input type="text" name="nome" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Unidade de Medida</label>
                <select name="unidade_medida" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione...</option>
                    <option value="UNIDADE">UNIDADE</option>
                    <option value="FRASCO">FRASCO</option>
                    <option value="RESMA">RESMA</option>
                    <option value="CAIXA">CAIXA</option>
                    <option value="PACOTE">PACOTE</option>
                </select>
            </div>
            <div class="flex space-x-3 pt-4">
                <button type="button" onclick="document.getElementById('modal-material').classList.add('hidden')" class="flex-1 p-3 rounded-xl font-bold text-[10px] text-gray-400 uppercase tracking-widest transition hover:bg-gray-100">Cancelar</button>
                <button type="submit" class="flex-1 bg-[#0B1437] text-white p-3 rounded-xl font-bold text-[10px] uppercase tracking-widest transition shadow-lg shadow-blue-900/20">Salvar Item</button>
            </div>
        </form>
    </div>
</div>
@endsection