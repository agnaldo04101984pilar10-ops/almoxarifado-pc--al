<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\LimiteController;
use App\Http\Controllers\AuthController;

// Rota inicial (Redireciona para o login se não estiver logado)
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de Autenticação (Acesso Público)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROTAS PROTEGIDAS (Só acessa quem estiver logado) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard / Home
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gerenciamento de Materiais
    Route::resource('materials', MaterialController::class);

    // Gerenciamento de Limites Mensais (Cotas por Setor)
    Route::get('/limites', [LimiteController::class, 'index'])->name('limites.index');
    Route::post('/limites', [LimiteController::class, 'store'])->name('limites.store');

});