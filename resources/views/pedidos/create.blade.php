@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-6 rounded-[32px] shadow-sm border border-gray-100 flex justify-between items-center">
        <div>
            <h3 class="text-xl font-black text-[#0B1437]">NOVA REQUISIÇÃO</h3>
            <p class="text-gray-400 text-xs font-bold uppercase">Setor Solicitante: <span class="text-blue-600">{{ Auth::user()->setor }}</span></p>
        </div>
        <a href="{{ route('pedidos.index') }}" class="text-gray-400 hover:text-[#0B1437] font-bold text-xs uppercase tracking-widest">Voltar</a>
    </div>

    <form action="{{ route('pedidos.store') }}" method="POST" id="form-requisicao">
        @csrf
        <div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100 space-y-8">
            
            <div class="bg-[#F4F7FE] p-6 rounded-2xl grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Código SIAP</label>
                    <input type="text" id="busca_siap" placeholder="Ex: 102030" class="w-full p-3 rounded-xl border-none focus:ring-2 focus:ring-blue-600 font-bold text-sm">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Descrição do Material</label>
                    <input type="text" id="desc_display" readonly class="w-full p-3 rounded-xl border-none bg-gray-200/50 font-bold text-sm text-gray-500" placeholder="Aguardando código...">
                </div>
                <button type="button" id="btn-adicionar" class="bg-[#0B1437] text-white p-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-blue-900 transition">
                    Inserir na Lista
                </button>
            </div>

            <div class="overflow-hidden border border-gray-100 rounded-2xl">
                <table class="w-full text-left" id="tabela-itens">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Código</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Material</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase">Unidade</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase w-32">Qtd</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase text-center">Remover</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        </tbody>
                </table>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-green-600/20 transition">
                    Enviar para Almoxarifado
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const inputSiap = document.getElementById('busca_siap');
    const inputDesc = document.getElementById('desc_display');
    const btnAdicionar = document.getElementById('btn-adicionar');
    const tabela = document.querySelector('#tabela-itens tbody');

    let materialSelecionado = null;

    // Busca Automática por SIAP
    inputSiap.addEventListener('blur', async function() {
        const codigo = this.value;
        if (codigo.length > 2) {
            const response = await fetch(`/buscar-material/${codigo}`);
            const material = await response.json();

            if (material) {
                inputDesc.value = `${material.nome} (${material.unidade_medida})`;
                materialSelecionado = material;
            } else {
                alert('Material não encontrado no SIAPNET.');
                this.value = '';
                inputDesc.value = '';
            }
        }
    });

    // Adicionar na Tabela
    btnAdicionar.addEventListener('click', function() {
        if (!materialSelecionado) return;

        const row = `
            <tr class="hover:bg-gray-50/50 transition">
                <td class="px-6 py-4 font-bold text-sm text-[#0B1437]">
                    ${materialSelecionado.codigo_siap}
                    <input type="hidden" name="materiais[]" value="${materialSelecionado.id}">
                </td>
                <td class="px-6 py-4 text-sm text-gray-600 font-medium">${materialSelecionado.nome}</td>
                <td class="px-6 py-4 text-xs font-bold text-blue-600 uppercase">${materialSelecionado.unidade_medida}</td>
                <td class="px-6 py-4">
                    <input type="number" name="quantidades[]" min="1" value="1" required
                        class="w-full p-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-600 font-bold text-sm text-center">
                </td>
                <td class="px-6 py-4 text-center">
                    <button type="button" onclick="this.closest('tr').remove()" class="text-red-400 hover:text-red-600 transition">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </td>
            </tr>
        `;

        tabela.insertAdjacentHTML('beforeend', row);
        
        // Limpa campos para o próximo item
        inputSiap.value = '';
        inputDesc.value = '';
        materialSelecionado = null;
        inputSiap.focus();
    });
</script>
@endsection