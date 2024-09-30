<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;

// Rota para a página inicial (opcional)
Route::get('/', function () {
    return view('welcome');
});

// Rotas para Estoque
Route::prefix('estoque')->group(function () {
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('/', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::get('/{id}', [EstoqueController::class, 'show'])->name('estoque.show');
    Route::get('/{id}/edit', [EstoqueController::class, 'edit'])->name('estoque.edit');
    Route::put('/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
    Route::delete('/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
});

// Rotas para Itens de Venda
Route::prefix('item_venda')->group(function () {
    Route::get('/', [ItemVendaController::class, 'index'])->name('item_venda.index');
    Route::get('/create', [ItemVendaController::class, 'create'])->name('item_venda.create');
    Route::post('/', [ItemVendaController::class, 'store'])->name('item_venda.store');
    Route::get('/{id}', [ItemVendaController::class, 'show'])->name('item_venda.show');
    Route::get('/{id}/edit', [ItemVendaController::class, 'edit'])->name('item_venda.edit');
    Route::put('/{id}', [ItemVendaController::class, 'update'])->name('item_venda.update');
    Route::delete('/{id}', [ItemVendaController::class, 'destroy'])->name('item_venda.destroy');
});

// Rotas para Produtos
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Rotas para Usuários
Route::prefix('usuarios')->group(function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

// Rotas para Vendas
Route::prefix('vendas')->group(function () {
    Route::get('/', [VendaController::class, 'index'])->name('vendas.index');
    Route::get('/create', [VendaController::class, 'create'])->name('vendas.create');
    Route::post('/', [VendaController::class, 'store'])->name('vendas.store');
    Route::get('/{id}', [VendaController::class, 'show'])->name('vendas.show');
    Route::get('/{id}/edit', [VendaController::class, 'edit'])->name('vendas.edit');
    Route::put('/{id}', [VendaController::class, 'update'])->name('vendas.update');
    Route::delete('/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy');
});

