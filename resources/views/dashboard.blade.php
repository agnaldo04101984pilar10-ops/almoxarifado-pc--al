@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="text-2xl font-bold text-[#0B1437]">Olá, {{ Auth::user()->name }}</h3>
        <p class="text-gray-400 text-sm">Setor: <span class="font-bold text-blue-900">Instituto de Criminalística</span></p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        @php
            $cards = [
                ['label' => 'Requisições Pendentes', 'value' => '12', 'color' => 'text-blue-600'],
                ['label' => 'Requisições Aprovadas (Mês)', 'value' => '08', 'color' => 'text-green-600'],
                ['label' => 'Entregues (Mês)', 'value' => '05', 'color' => 'text-purple-600'],
                ['label' => 'Itens em Estoque', 'value' => '236', 'color' => 'text-orange-500'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
            <p class="text-4xl font-black {{ $card['color'] }} mb-2">{{ $card['value'] }}</p>
            <p class="text-xs font-bold text-gray-500 uppercase leading-tight">{{ $card['label'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-6">
                <h4 class="font-bold text-[#0B1437]">Consumo Mensal (por setor)</h4>
                <select class="bg-gray-50 border-none text-xs font-bold rounded-lg px-3 py-1">
                    <option>Junho / 2024</option>
                </select>
            </div>
            <div class="h-64 flex items-end justify-around space-x-2">
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 60%"></div>
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 80%"></div>
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 100%"></div>
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 70%"></div>
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 90%"></div>
                <div class="bg-blue-600 w-12 rounded-t-lg" style="height: 65%"></div>
            </div>
            <div class="flex justify-around mt-4 text-[10px] font-bold text-gray-400 uppercase">
                <span>Jan</span><span>Fev</span><span>Mar</span><span>Abr</span><span>Mai</span><span>Jun</span>
            </div>
        </div>

        <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 flex flex-col justify-between">
            <div>
                <h4 class="font-bold text-[#0B1437] mb-6">Limite Mensal do Setor</h4>
                <p class="text-2xl font-black text-[#0B1437]">R$ 25.000,00</p>
                <p class="text-xs text-gray-400 font-bold mb-8 uppercase">Limite disponível</p>
                
                <div class="relative w-32 h-32 mx-auto mb-8">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="text-green-500" stroke-width="3" stroke-dasharray="68, 100" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center font-black text-xl text-gray-700">68%</div>
                </div>
            </div>

            <div class="border-t pt-4">
                <p class="text-xl font-black text-[#0B1437]">R$ 17.120,50</p>
                <p class="text-[10px] text-gray-400 font-bold uppercase">Total consumido</p>
            </div>
        </div>
    </div>
</div>
@endsection