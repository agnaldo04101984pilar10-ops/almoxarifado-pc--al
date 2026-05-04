<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Almoxarifado - Polícia Científica de Alagoas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F4F7FE] antialiased">
    <div class="min-h-screen flex">
        <!-- Lado Esquerdo: Identidade Visual -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#0B1437] items-center justify-center p-12 text-center text-white relative">
            <div class="relative z-10">
                <img src="{{ asset('images/brasao.png') }}" alt="Brasão PC-AL" class="w-64 h-auto mx-auto mb-8 shadow-2xl">
                <h1 class="text-4xl font-extrabold tracking-tight mb-2 uppercase">Polícia Científica</h1>
                <p class="text-2xl font-light tracking-[0.2em] mb-8">DO ESTADO DE ALAGOAS</p>
                <div class="h-0.5 w-24 bg-blue-500 mx-auto mb-8"></div>
                <h2 class="text-xl font-bold tracking-widest uppercase opacity-80">Sistema de Gestão<br>de Almoxarifado</h2>
            </div>
            <div class="absolute inset-0 opacity-10 pointer-events-none overflow-hidden">
                <i class="fa-solid fa-shield-halved text-[40rem] -bottom-20 -left-20 absolute"></i>
            </div>
        </div>

        <!-- Lado Direito: Onde o conteúdo entra -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white lg:bg-[#F4F7FE]">
            <div class="w-full max-w-md bg-white p-10 rounded-[32px] shadow-2xl border border-gray-100">
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl text-xs font-bold uppercase">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>