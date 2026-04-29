@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
    <h3 class="text-xl font-black text-[#0B1437] uppercase mb-6">Configurar Limites Mensais</h3>

    <form action="{{ route('limites.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        @csrf
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Setor</label>
            <select name="setor" class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm">
                @foreach($setores as $s) <option value="{{ $s }}">{{ $s }}</option> @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Material</label>
            <select name="material_id" class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm">
                @foreach($materials as $m) <option value="{{ $m->id }}">{{ $m->nome }}</option> @endforeach
            </select>
        </div>
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Cota Mensal</label>
            <input type="number" name="quantidade_limite" class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm">
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-xl font-black text-[10px] uppercase">Definir Limite</button>
        </div>
    </form>

    <table class="w-full">
        <thead>
            <tr class="text-left border-b border-gray-100">
                <th class="py-4 text-[10px] font-black text-gray-400 uppercase">Setor</th>
                <th class="py-4 text-[10px] font-black text-gray-400 uppercase">Material</th>
                <th class="py-4 text-[10px] font-black text-gray-400 uppercase">Limite</th>
            </tr>
        </thead>
        <tbody>
            @foreach($limites as $l)
            <tr class="border-b border-gray-50">
                <td class="py-4 font-bold text-sm">{{ $l->setor }}</td>
                <td class="py-4 font-bold text-sm">{{ $l->material->nome }}</td>
                <td class="py-4 font-black text-blue-600">{{ $l->quantidade_limite }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection