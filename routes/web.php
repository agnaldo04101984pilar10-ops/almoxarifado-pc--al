<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\SetorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // MATERIAIS (Completo: Ver, Criar, Editar e Excluir)
    Route::get('/materiais', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materiais/novo', [MaterialController::class, 'create'])->name('materials.create');
    Route::post('/materiais', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materiais/{id}/editar', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::put('/materiais/{id}', [MaterialController::class, 'update'])->name('materials.update');
    Route::delete('/materiais/{id}', [MaterialController::class, 'destroy'])->name('materials.destroy');

    // PEDIDOS
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/novo', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');

    // SETORES
    Route::get('/setores', [SetorController::class, 'index'])->name('setores.index');
    Route::get('/setores/novo', [SetorController::class, 'create'])->name('setores.create');
    Route::post('/setores', [SetorController::class, 'store'])->name('setores.store');
    Route::get('/setores/{id}/editar', [SetorController::class, 'edit'])->name('setores.edit');
    Route::put('/setores/{id}', [SetorController::class, 'update'])->name('setores.update');
    Route::delete('/setores/{id}', [SetorController::class, 'destroy'])->name('setores.destroy');
});

require __DIR__.'/auth.php';