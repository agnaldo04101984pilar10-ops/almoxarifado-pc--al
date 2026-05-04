@extends('layouts.app')

@section('content')
<div class="bg-white p-8 rounded-[32px] shadow-sm border border-gray-100">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black text-[#0B1437] uppercase text-blue-600">Solicitações de Cadastro</h1>
            <p class="text-gray-400 text-sm font-bold tracking-tight">Usuários aguardando liberação para acessar o sistema</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-600 rounded-2xl text-xs font-black uppercase border border-green-100 animate-pulse">
            <i class="fa-solid fa-check-double mr-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-left border-b border-gray-50">
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Nome do Servidor</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest">Setor / Unidade</th>
                    <th class="pb-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50/50 transition-all">
                    <td class="py-5">
                        <div class="font-bold text-[#0B1437]">{{ $u->name }}</div>
                        <div class="text-[11px] text-gray-400 font-medium">{{ $u->email }}</div>
                    </td>
                    <td class="py-5">
                        <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-tighter">
                            {{ $u->setor }}
                        </span>
                    </td>
                    <td class="py-5 text-right">
                        <form action="{{ route('usuarios.aprovar', $u->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-blue-600 hover:bg-[#0B1437] text-white px-6 py-2.5 rounded-xl text-[10px] font-black uppercase transition-all shadow-lg shadow-blue-100 flex items-center gap-2 ml-auto">
                                <i class="fa-solid fa-user-check"></i>
                                Aprovar Cadastro
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="py-20 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                            <i class="fa-solid fa-user-clock text-gray-200 text-2xl"></i>
                        </div>
                        <p class="text-gray-400 font-bold uppercase text-[10px] tracking-widest">Nenhuma solicitação pendente no momento</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection