@extends('layouts.guest')

@section('content')
<div class="mb-8 text-center">
    <h1 class="text-2xl font-black text-[#0B1437] uppercase">Solicitar Cadastro</h1>
    <p class="text-gray-400 text-sm font-bold">Seu acesso passará por aprovação</p>
</div>

<form action="{{ route('register') }}" method="POST" class="space-y-4">
    @csrf
    
    <div>
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 ml-1">Nome Completo</label>
        <input type="text" name="name" value="{{ old('name') }}" required 
               class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
    </div>

    <div>
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 ml-1">E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required 
               class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
    </div>

    <div>
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 ml-1">Setor / Unidade</label>
        <select name="setor" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
            <option value="">Selecione...</option>
            <option value="IML - Maceió">IML - Maceió</option>
            <option value="IML - Arapiraca">IML - Arapiraca</option>
            <option value="IC - Maceió">IC - Maceió</option>
            <option value="Diretoria">Diretoria</option>
        </select>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 ml-1">Senha</label>
            <input type="password" name="password" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase mb-1 ml-1">Confirmar</label>
            <input type="password" name="password_confirmation" required class="w-full p-3 bg-[#F4F7FE] rounded-xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        </div>
    </div>

    <button type="submit" class="w-full bg-blue-600 py-4 rounded-2xl text-white font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-100 mt-4 hover:bg-blue-700">
        Enviar Solicitação
    </button>

    <div class="text-center mt-4">
        <a href="{{ route('login') }}" class="text-[10px] font-black text-gray-400 uppercase hover:text-blue-600">Voltar ao Login</a>
    </div>
</form>
@endsection