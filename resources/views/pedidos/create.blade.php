<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Pedido</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div style="background-color: #fee2e2; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form action="{{ route('pedidos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">Material:</label>
                        <select name="material_id" class="w-full border-gray-300 rounded-md" required>
                            <option value="">Selecione...</option>
                            @foreach($materiais as $material)
                                <option value="{{ $material->id }}">
                                    {{ $material->descricao }} (R$ {{ number_format($material->preco, 2, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block font-bold">Quantidade:</label>
                        <input type="number" name="quantidade" min="1" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    <button type="submit" style="background-color: #059669; color: white; padding: 10px 20px; border-radius: 6px; font-weight: bold;">
                        Confirmar Pedido
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>