<?php
//routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ItemVendaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Log; // Importa a classe Log

// Rota para a página inicial (opcional)
Route::get('/', function () {
    Log::debug('Acessando a página inicial');
    return view('welcome');
});

// Rotas para Estoque
Route::prefix('api/estoque')->middleware(CorsMiddleware::class)->group(function () {
    Log::debug('Grupo de rotas para Estoque iniciado');
    
    Route::get('/', [EstoqueController::class, 'index'])->name('estoque.index')->middleware(function ($request, $next) {
        Log::debug('Rota estoque.index acessada');
        return $next($request);
    });
    
    Route::get('/{id}', [EstoqueController::class, 'show'])->name('estoque.show')->middleware(function ($request, $next) {
        Log::debug('Rota estoque.show acessada com ID: ' . $request->id);
        return $next($request);
    });
    
    Route::post('/', [EstoqueController::class, 'store'])->name('estoque.store')->middleware(function ($request, $next) {
        Log::debug('Rota estoque.store acessada. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::put('/{id}', [EstoqueController::class, 'update'])->name('estoque.update')->middleware(function ($request, $next) {
        Log::debug('Rota estoque.update acessada para o item de ID: ' . $request->id . '. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::delete('/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy')->middleware(function ($request, $next) {
        Log::debug('Rota estoque.destroy acessada para o item de ID: ' . $request->id);
        return $next($request);
    });
});

// Rotas para Itens de Venda
Route::prefix('api/item_venda')->middleware(CorsMiddleware::class)->group(function () {
    Log::debug('Grupo de rotas para Itens de Venda iniciado');
    
    Route::get('/', [ItemVendaController::class, 'index'])->name('item_venda.index')->middleware(function ($request, $next) {
        Log::debug('Rota item_venda.index acessada');
        return $next($request);
    });
    
    Route::get('/{id}', [ItemVendaController::class, 'show'])->name('item_venda.show')->middleware(function ($request, $next) {
        Log::debug('Rota item_venda.show acessada com ID: ' . $request->id);
        return $next($request);
    });
    
    Route::post('/', [ItemVendaController::class, 'store'])->name('item_venda.store')->middleware(function ($request, $next) {
        Log::debug('Rota item_venda.store acessada. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::put('/{id}', [ItemVendaController::class, 'update'])->name('item_venda.update')->middleware(function ($request, $next) {
        Log::debug('Rota item_venda.update acessada para o item de ID: ' . $request->id . '. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::delete('/{id}', [ItemVendaController::class, 'destroy'])->name('item_venda.destroy')->middleware(function ($request, $next) {
        Log::debug('Rota item_venda.destroy acessada para o item de ID: ' . $request->id);
        return $next($request);
    });
});

// Rotas para Produtos
Route::prefix('api/products')->middleware(CorsMiddleware::class)->group(function () {
    Log::debug('Grupo de rotas para Produtos iniciado');
    
    Route::get('/', [ProductController::class, 'index'])->name('products.index')->middleware(function ($request, $next) {
        Log::debug('Rota products.index acessada');
        return $next($request);
    });
    
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show')->middleware(function ($request, $next) {
        Log::debug('Rota products.show acessada com ID: ' . $request->id);
        return $next($request);
    });
    
    Route::post('/', [ProductController::class, 'store'])->name('products.store')->middleware(function ($request, $next) {
        Log::debug('Rota products.store acessada. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update')->middleware(function ($request, $next) {
        Log::debug('Rota products.update acessada para o produto de ID: ' . $request->id . '. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware(function ($request, $next) {
        Log::debug('Rota products.destroy acessada para o produto de ID: ' . $request->id);
        return $next($request);
    });
});

// Rotas para Usuários
Route::prefix('api/usuarios')->middleware(CorsMiddleware::class)->group(function () {
    Log::debug('Grupo de rotas para Usuários iniciado');
    
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index')->middleware(function ($request, $next) {
        Log::debug('Rota usuarios.index acessada');
        return $next($request);
    });
    
    Route::get('/{id}', [UsuarioController::class, 'show'])->name('usuarios.show')->middleware(function ($request, $next) {
        Log::debug('Rota usuarios.show acessada com ID: ' . $request->id);
        return $next($request);
    });
    
    Route::post('/', [UsuarioController::class, 'store'])->name('usuarios.store')->middleware(function ($request, $next) {
        Log::debug('Rota usuarios.store acessada. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update')->middleware(function ($request, $next) {
        Log::debug('Rota usuarios.update acessada para o usuário de ID: ' . $request->id . '. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::delete('/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy')->middleware(function ($request, $next) {
        Log::debug('Rota usuarios.destroy acessada para o usuário de ID: ' . $request->id);
        return $next($request);
    });
});

// Rotas para Vendas
Route::prefix('api/vendas')->middleware(CorsMiddleware::class)->group(function () {
    Log::debug('Grupo de rotas para Vendas iniciado');
    
    Route::get('/', [VendaController::class, 'index'])->name('vendas.index')->middleware(function ($request, $next) {
        Log::debug('Rota vendas.index acessada');
        return $next($request);
    });
    
    Route::get('/{id}', [VendaController::class, 'show'])->name('vendas.show')->middleware(function ($request, $next) {
        Log::debug('Rota vendas.show acessada com ID: ' . $request->id);
        return $next($request);
    });
    
    Route::post('/', [VendaController::class, 'store'])->name('vendas.store')->middleware(function ($request, $next) {
        Log::debug('Rota vendas.store acessada. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::put('/{id}', [VendaController::class, 'update'])->name('vendas.update')->middleware(function ($request, $next) {
        Log::debug('Rota vendas.update acessada para a venda de ID: ' . $request->id . '. Dados recebidos: ', $request->all());
        return $next($request);
    });
    
    Route::delete('/{id}', [VendaController::class, 'destroy'])->name('vendas.destroy')->middleware(function ($request, $next) {
        Log::debug('Rota vendas.destroy acessada para a venda de ID: ' . $request->id);
        return $next($request);
    });
});
