<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\RelatoriosController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rota para o Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Rotas para Controle de Estoque
Route::resource('estoque', EstoqueController::class)->except(['show']);
Route::resource('estoque', EstoqueController::class);


// Rotas para Registro de Vendas
Route::resource('vendas', VendasController::class)->except(['show']);

// Rotas para Geração de Relatórios
Route::get('relatorios', [RelatoriosController::class, 'index'])->name('relatorios.index');

// Rotas para Cadastro de Produtos
Route::resource('produtos', ProdutosController::class)->except(['show']);

// Rotas para Cadastro de Clientes
Route::resource('clientes', ClientesController::class)->except(['show']);

// Rotas para Gestão de Usuários
Route::resource('usuarios', UsuariosController::class)->except(['show']);
