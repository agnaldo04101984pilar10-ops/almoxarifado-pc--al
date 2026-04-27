<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Polícia Científica AL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { margin: 0; padding: 0; font-family: 'figtree', sans-serif; }
        .login-container {
            display: flex;
            min-height: 100vh;
        }
        /* LADO ESQUERDO - AZUL ESCURO */
        .login-sidebar {
            flex: 1;
            background-color: #001533; /* Azul escuro oficial */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 40px;
            text-align: center;
        }
        .login-sidebar img {
            width: 250px;
            margin-bottom: 20px;
        }
        .login-sidebar h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .login-sidebar p {
            font-size: 1.2rem;
            color: #d1d5db;
        }
        
        /* LADO DIREITO - BRANCO */
        .login-content {
            flex: 1;
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }
        .login-card h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #111827;
            margin-bottom: 30px;
        }
        
        /* Ajuste para ecrãs pequenos */
        @media (max-width: 768px) {
            .login-container { flex-direction: column; }
            .login-sidebar { padding: 40px 20px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-sidebar">
            <img src="{{ asset('images/brasao.png') }}" alt="Brasão Polícia Científica AL" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/b/b3/Bras%C3%A3o_da_Pol%C3%ADcia_Cient%C3%ADfica_de_Alagoas.png'">
            
            <h1>POLÍCIA CIENTÍFICA</h1>
            <p>DO ESTADO DE ALAGOAS</p>
            <div style="margin-top: 40px; font-weight: 300; letter-spacing: 2px;">
                SISTEMA DE GESTÃO<br>DE ALMOXARIFADO
            </div>
        </div>

        <div class="login-content">
            <div class="login-card">
                <h2>Acesse sua conta</h2>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>