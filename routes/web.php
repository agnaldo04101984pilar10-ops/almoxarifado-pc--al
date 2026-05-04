<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\LimiteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\EstoqueController;

// Rota inicial - Redireciona para o login
Route::get('/', function () {
    return redirect()->route('login');
});

// --- ROTAS DE AUTENTICAÇÃO (Acesso Público) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/registro', [AuthController::class, 'showRegistro'])->name('register');
Route::post('/registro', [AuthController::class, 'registro']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROTAS PROTEGIDAS (Só acessa quem estiver logado e ativo) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos/{id}/pdf', [PedidoController::class, 'gerarPdf'])->name('pedidos.pdf');
    Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/entradas/nova', [EntradaController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');
    
    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gerenciamento de Materiais (CRUD completo)
    Route::resource('materiais', MaterialController::class);

    // Gerenciamento de Pedidos (Requisições)
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/novo', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::post('/pedidos/{id}/atender', [PedidoController::class, 'atender'])->name('pedidos.atender');

    // Gerenciamento de Limites Mensais (Cotas)
    Route::get('/limites', [LimiteController::class, 'index'])->name('limites.index');
    Route::post('/limites', [LimiteController::class, 'store'])->name('limites.store');

    // --- ÁREA DO ADMINISTRADOR CENTRAL (Gestão de Usuários) ---
    Route::get('/usuarios/pendentes', [AuthController::class, 'listaPendentes'])->name('usuarios.pendentes');
    Route::post('/usuarios/{id}/aprovar', [AuthController::class, 'aprovar'])->name('usuarios.aprovar');
});