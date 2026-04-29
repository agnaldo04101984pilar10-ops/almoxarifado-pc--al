<x-guest-layout>
    <div class="mb-8">
        <h3 class="text-3xl font-extrabold text-[#0B1437] mb-2">Acesse sua conta</h3>
        <p class="text-gray-400 text-sm font-medium">Informe suas credenciais para entrar</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-2">Usuário</label>
            <div class="relative">
                <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                    placeholder="Digite seu e-mail"
                    class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label class="block text-sm font-bold text-[#0B1437] mb-2">Senha</label>
            <div class="relative">
                <input id="password" type="password" name="password" required 
                    placeholder="Digite sua senha"
                    class="w-full p-4 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-900 outline-none transition text-sm font-semibold">
                <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-900">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between text-xs font-bold">
            <label class="flex items-center text-gray-500 cursor-pointer">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-900 focus:ring-blue-900 mr-2">
                Lembrar-me
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Esqueceu sua senha?</a>
            @endif
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-[#0B1437] hover:bg-[#1a2b6d] text-white font-extrabold py-4 rounded-2xl transition shadow-xl shadow-blue-900/20 uppercase text-sm tracking-widest">
                Entrar
            </button>
        </div>

        <div class="text-center pt-6 border-t border-gray-100 mt-6">
            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider">
                Não possui acesso? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 ml-1 underline">Solicitar Cadastro</a>
            </p>
        </div>
    </form>
</x-guest-layout>