@extends('layouts.guest')

@section('content')
<div class="mb-8 text-center">
    <h1 class="text-2xl font-black text-[#0B1437] uppercase">Acessar Sistema</h1>
    <p class="text-gray-400 text-sm font-bold">Entre com suas credenciais</p>
</div>

<form action="{{ route('login') }}" method="POST" class="space-y-6">
    @csrf
    <div>
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">E-mail Institucional</label>
        <input type="email" name="email" required 
               class="w-full p-4 bg-[#F4F7FE] rounded-2xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
        @error('email') <p class="text-red-500 text-[10px] mt-1 font-bold uppercase">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-[10px] font-black text-gray-400 uppercase mb-2 ml-1">Senha</label>
        <input type="password" name="password" required 
               class="w-full p-4 bg-[#F4F7FE] rounded-2xl border-none font-bold text-sm focus:ring-2 focus:ring-blue-500 outline-none">
    </div>

    <button type="submit" class="w-full bg-[#0B1437] py-4 rounded-2xl text-white font-black text-xs uppercase tracking-widest shadow-xl hover:bg-blue-900 transition-all">
        Entrar no Sistema
    </button>

    <div class="text-center pt-6 border-t border-gray-100 mt-6">
        <p class="text-gray-400 text-[10px] font-black uppercase">
            Não possui acesso? 
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline ml-1">Solicitar Cadastro</a>
        </p>
    </div>
</form>
@endsection