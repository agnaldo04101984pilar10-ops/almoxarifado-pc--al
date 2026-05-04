<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('materials.update', $material->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Descrição do Material:</label>
                            <input type="text" name="descricao" value="{{ $material->descricao }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Estoque Atual:</label>
                            <input type="number" name="estoque_atual" value="{{ $material->estoque_atual }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Preço Unitário (R$):</label>
                            <input type="number" name="preco" step="0.01" value="{{ $material->preco }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('materials.index') }}" class="mr-4 text-gray-600 hover:underline">Cancelar</a>
                            <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;">
                                Atualizar Material
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>