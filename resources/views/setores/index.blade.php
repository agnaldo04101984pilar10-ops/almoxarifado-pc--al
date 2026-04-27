<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Setores Cadastrados</h2>
            <a href="{{ route('setores.create') }}" style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;">+ Novo Setor</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div style="background-color: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background-color: #f3f4f6;">
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 10%;">ID</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 40%;">Nome do Setor</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 25%;">Limite Mensal</th>
                                <th style="padding: 12px; border-bottom: 2px solid #e5e7eb; width: 25%; text-align: center;">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($setores as $setor)
                                <tr>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $setor->id }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">{{ $setor->nome }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6;">R$ {{ number_format($setor->limite_mensal, 2, ',', '.') }}</td>
                                    <td style="padding: 12px; border-bottom: 1px solid #f3f4f6; text-align: center; display: flex; justify-content: center; gap: 15px;">
                                        <a href="{{ route('setores.edit', $setor->id) }}" style="color: #2563eb; font-weight: bold; text-decoration: none;">Editar</a>
                                        <form action="{{ route('setores.destroy', $setor->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este setor?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="color: #dc2626; font-weight: bold; background: none; border: none; cursor: pointer;">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" style="padding: 20px; text-align: center;">Nenhum setor.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>