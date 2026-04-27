<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Material (SIAP)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('materials.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="codigo_siap" :value="__('Código SIAP')" />
                            <x-text-input id="codigo_siap" name="codigo_siap" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="unidade_medida" :value="__('Unidade (Ex: Resma, Cx, Un)')" />
                            <x-text-input id="unidade_medida" name="unidade_medida" type="text" class="mt-1 block w-full" required />
                        </div>
                         
                        <div class="mb-4">
                          <label class="block text-gray-700 font-bold mb-2">Preço Unitário (R$):</label>
                          <input type="number" name="preco_unitario" step="0.01" min="0" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Ex: 10.50" required>
                          <small class="text-gray-500">Use ponto para centavos (Ex: 10.50)</small>
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="descricao" :value="__('Descrição do Material')" />
                            <x-text-input id="descricao" name="descricao" type="text" class="mt-1 block w-full" required />
                        </div>

                        <div>
                            <x-input-label for="estoque_atual" :value="__('Estoque Inicial')" />
                            <x-text-input id="estoque_atual" name="estoque_atual" type="number" class="mt-1 block w-full" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                            {{ __('Salvar Material') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>