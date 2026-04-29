<x-guest-layout>
    <div class="mb-8">
        <h3 class="text-3xl font-extrabold text-[#0B1437] mb-2">Solicitar Acesso</h3>
        <p class="text-gray-400 text-sm font-medium">Crie sua conta para gerenciar o estoque</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-1">Nome Completo</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-1">E-mail Institucional</label>
            <input id="email" type="email" name="email" :value="old('email')" required 
                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-1">Senha</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" 
                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-1">Confirmar Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required 
                class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-[#0B1437] hover:bg-[#1a2b6d] text-white font-extrabold py-4 rounded-2xl transition shadow-xl shadow-blue-900/20 uppercase text-sm tracking-widest">
                Cadastrar Conta
            </button>
        </div>

        <div class="text-center pt-4">
            <a href="{{ route('login') }}" class="text-xs font-bold text-blue-600 hover:underline uppercase">Já tenho uma conta? Entrar</a>
        </div>
    </form>
</x-guest-layout>