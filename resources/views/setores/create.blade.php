<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cadastrar Novo Setor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('setores.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block font-bold mb-2">Nome do Setor:</label>
                        <input type="text" name="nome" class="w-full border-gray-300 rounded-md" placeholder="Ex: Almoxarifado Central" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold mb-2">Limite Mensal de Gastos (R$):</label>
                        <input type="number" name="limite_mensal" step="0.01" class="w-full border-gray-300 rounded-md" placeholder="Ex: 5000.00" required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold; border: none; cursor: pointer;">
                            Salvar Setor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>