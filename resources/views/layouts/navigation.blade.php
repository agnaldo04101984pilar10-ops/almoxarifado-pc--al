<div class="p-6">
    <div class="flex flex-col items-center mb-10">
        <img src="{{ asset('images/brasao.png') }}" alt="PC-AL" class="w-20 mb-2">
        <span class="text-xs font-bold text-center">POLÍCIA CIENTÍFICA</span>
        <span class="text-[10px] text-blue-300">ALAGOAS</span>
    </div>

    <nav class="space-y-4">
        <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-800 transition font-bold text-sm">
            📊 Painel Principal
        </a>
        <a href="/materials" class="block px-4 py-2 rounded hover:bg-blue-800 transition font-bold text-sm">
            📦 Materiais
        </a>
        <a href="#" class="block px-4 py-2 rounded hover:bg-blue-800 transition font-bold text-sm">
            📝 Pedidos
        </a>
        
        <hr class="border-blue-800 my-4">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-red-400 hover:text-red-200 font-bold text-sm">
                ✕ Sair do Sistema
            </button>
        </form>
    </nav>
</div>