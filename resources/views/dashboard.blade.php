<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="background: #1e3a8a; padding: 10px; border-radius: 8px;">
                <span style="color: white; font-weight: bold; font-size: 20px;">POLÍCIA CIENTÍFICA</span>
            </div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('ALAGOAS - Gestão de Almoxarifado') }}
            </h2>
        </div>
    </x-slot>

    <div style="background-color: #f1f5f9; min-height: 100vh; padding: 30px;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <div style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
                
                <div style="flex: 1; min-width: 280px; background: #fff; padding: 25px; border-radius: 12px; border-top: 6px solid #1e3a8a; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
                    <h3 style="color: #64748b; font-size: 13px; font-weight: 800; text-transform: uppercase;">📦 Total em Itens</h3>
                    <p style="font-size: 32px; font-weight: 900; color: #1e3a8a; margin: 5px 0;">{{ $totalMateriais }}</p>
                </div>

                <div style="flex: 1; min-width: 280px; background: #fff; padding: 25px; border-radius: 12px; border-top: 6px solid #b91c1c; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
                    <h3 style="color: #64748b; font-size: 13px; font-weight: 800; text-transform: uppercase;">⚠️ Alerta de Reposição</h3>
                    <p style="font-size: 32px; font-weight: 900; color: #b91c1c; margin: 5px 0;">{{ $estoqueBaixo->count() }}</p>
                </div>

                <div style="flex: 1; min-width: 280px; background: #fff; padding: 25px; border-radius: 12px; border-top: 6px solid #ca8a04; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);">
                    <h3 style="color: #64748b; font-size: 13px; font-weight: 800; text-transform: uppercase;">💸 Consumo Mensal</h3>
                    <p style="font-size: 32px; font-weight: 900; color: #ca8a04; margin: 5px 0;">R$ {{ number_format($gastoMes, 2, ',', '.') }}</p>
                </div>
            </div>

            <div style="display: flex; gap: 25px; flex-wrap: wrap; margin-bottom: 30px;">
                
                <div style="flex: 2; min-width: 500px; background: white; padding: 25px; border-radius: 15px; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);">
                    <h3 style="font-weight: bold; color: #1e293b; margin-bottom: 20px;">Gasto por Setor (Mês Vigente)</h3>
                    <canvas id="graficoSetores" height="150"></canvas>
                </div>

                <div style="flex: 1; min-width: 300px; background: #1e293b; padding: 25px; border-radius: 15px; color: white; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);">
                    <h3 style="font-weight: bold; border-bottom: 1px solid #334155; padding-bottom: 15px; margin-bottom: 15px; color: #f1f5f9;">🚨 Reposição Imediata</h3>
                    <ul style="list-style: none; padding: 0;">
                        @forelse($estoqueBaixo as $item)
                            <li style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #334155;">
                                <span>{{ $item->descricao }}</span>
                                <span style="color: #f87171; font-weight: bold;">{{ $item->estoque_atual }} un.</span>
                            </li>
                        @empty
                            <li style="color: #94a3b8; text-align: center; padding-top: 20px;">Estoque conforme padrão.</li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('graficoSetores').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Gasto (R$)',
                    data: {!! json_encode($valores) !!},
                    backgroundColor: '#3b82f6',
                    borderColor: '#1e3a8a',
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>