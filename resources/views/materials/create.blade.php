@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-2xl">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#001533]">Cadastrar Novo Item</h1>
        <p class="text-gray-500">Adicionar material ao estoque da Polícia Científica</p>
    </div>

    <form action="{{ route('materials.store') }}" method="POST" class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
        @csrf
        
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Descrição do Material</label>
            <input type="text" name="nome" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" placeholder="Ex: Luvas, Lacre, Reagente..." required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Código SIAP</label>
            <input type="text" name="codigo_siap" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" placeholder="Digite o código SIAP" required>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Quantidade Inicial</label>
            <input type="number" name="quantidade" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-600 outline-none" placeholder="0" required>
        </div>

        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('materials.index') }}" class="text-gray-500 font-bold">Cancelar</a>
            <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                Salvar no Estoque
            </button>
        </div>
    </form>
</div>
@endsection