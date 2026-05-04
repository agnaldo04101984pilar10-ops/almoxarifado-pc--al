<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almoxarifado - PC/AL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        .sidebar-content {
            height: calc(100vh - 220px);
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 8px;
        }

        .sidebar-content::-webkit-scrollbar { width: 6px; }
        .sidebar-content::-webkit-scrollbar-track { background: transparent; }
        .sidebar-content::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .sidebar-content:hover::-webkit-scrollbar-thumb {
            background: #3b82f6;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }

        .nav-item .indicator {
            width: 4px;
            height: 20px;
            background-color: #3b82f6;
            border-radius: 99px;
            opacity: 0;
            transition: all 0.3s ease;
            position: absolute;
            right: 0;
        }
        .nav-item:hover .indicator, .nav-item.active .indicator {
            opacity: 1;
            height: 30px;
        }
    </style>
</head>
<body class="bg-[#F4F7FE]">
    <div class="flex min-h-screen">
        <aside class="w-72 bg-[#0B1437] text-white fixed h-full shadow-2xl flex flex-col">
            <div class="p-8 flex flex-col items-center border-b border-white/10 flex-shrink-0">
                <img src="{{ asset('images/brasao.png') }}" alt="PC-AL" class="w-16 h-auto mb-3">
                <div class="text-center">
                    <h1 class="text-[10px] font-extrabold tracking-[0.2em] text-white/90 leading-tight uppercase">Polícia Científica</h1>
                    <p class="text-[8px] text-blue-400 font-bold uppercase tracking-widest">Alagoas</p>
                </div>
            </div>

            <nav class="sidebar-content px-4 py-6 space-y-2">
                @php
                    // Buscamos a contagem de pendentes para exibir no menu "Cadastros"
                    $pendentesCount = \App\Models\User::where('status', 'pendente')->count();

                    $menus = [
                        ['icon' => 'fa-house', 'label' => 'Dashboard', 'route' => 'dashboard'],
                        ['icon' => 'fa-file-signature', 'label' => 'Requisições', 'route' => 'pedidos.index'],
                        ['icon' => 'fa-boxes-stacked', 'label' => 'Materiais', 'route' => 'materiais.index'],
                        ['icon' => 'fa-right-to-bracket', 'label' => 'Entradas', 'route' => 'entradas.create'],
                        ['icon' => 'fa-right-from-bracket', 'label' => 'Saídas', 'route' => '#'],
                        ['icon' => 'fa-warehouse', 'label' => 'Estoque', 'route' => '#'],
                        ['icon' => 'fa-chart-pie', 'label' => 'Limites Mensais', 'route' => '#'],
                        ['icon' => 'fa-file-lines', 'label' => 'Relatórios', 'route' => '#'],
                        // ATUALIZADO: Rota de usuários pendentes inserida aqui
                        ['icon' => 'fa-address-card', 'label' => 'Cadastros', 'route' => 'usuarios.pendentes'],
                        ['icon' => 'fa-gears', 'label' => 'Configurações', 'route' => '#'],
                    ];
                @endphp

                @foreach($menus as $menu)
                    <a href="{{ ($menu['route'] != '#' && Route::has($menu['route'])) ? route($menu['route']) : '#' }}" 
                       class="nav-item relative flex items-center justify-between px-5 py-3 rounded-2xl transition-all duration-300 {{ Request::routeIs($menu['route']) ? 'active bg-white/10 text-white' : 'text-gray-400 hover:bg-white/5' }}">
                        
                        <div class="flex items-center space-x-4">
                            <i class="fa-solid {{ $menu['icon'] }} w-5 text-center text-lg"></i>
                            <span class="text-[13px] font-semibold tracking-wide">{{ $menu['label'] }}</span>
                        </div>

                        {{-- ALERTA DE CADASTROS PENDENTES --}}
                        @if($menu['label'] == 'Cadastros' && $pendentesCount > 0)
                            <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-lg animate-pulse shadow-lg shadow-red-500/20">
                                {{ $pendentesCount }}
                            </span>
                        @endif

                        <div class="indicator"></div>
                    </a>
                @endforeach
            </nav>

            <div class="p-6 border-t border-white/10 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center space-x-3 px-4 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 rounded-2xl font-bold text-xs transition duration-300">
                        <i class="fa-solid fa-power-off"></i>
                        <span>SAIR DO SISTEMA</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 ml-72 p-8">
            <header class="flex justify-between items-center mb-8 bg-white/60 backdrop-blur-xl p-5 rounded-3xl shadow-sm border border-white/20">
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Páginas / Dashboard</p>
                    <h2 class="text-[#0B1437] text-2xl font-extrabold uppercase">Painel Principal</h2>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="flex items-center bg-[#F4F7FE] p-2 pr-4 rounded-full space-x-4 shadow-inner">
                        <div class="flex items-center space-x-3">
                            <div class="text-right leading-tight border-r pr-3 border-gray-200">
                                <p class="text-xs font-black text-[#0B1437]">{{ Auth::user()->name }}</p>
                                <p class="text-[9px] text-blue-600 font-bold uppercase">{{ Auth::user()->setor }}</p>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0B1437&color=fff" class="w-10 h-10 rounded-full shadow-md">
                        </div>
                    </div>
                </div>
            </header>

            @yield('content')
        </main>
    </div>
</body>
</html>