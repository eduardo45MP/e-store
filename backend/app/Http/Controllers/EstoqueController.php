<?php

// app/Http/Controllers/EstoqueController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    // Retorna todos os itens de estoque como JSON
    public function index()
    {
        $itensEstoque = Estoque::with('produto')->get();
        return response()->json($itensEstoque);  // Retorna os dados em formato JSON
    }

    // Exibe um item específico de estoque como JSON
    public function show($id)
    {
        $itemEstoque = Estoque::with('produto')->findOrFail($id);
        return response()->json($itemEstoque);  // Retorna os dados em formato JSON
    }

    // Cria um novo item de estoque
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'tipo_movimentacao' => 'required|string',
            'data_movimentacao' => 'required|date',
        ]);

        $estoque = Estoque::create($validatedData);
        return response()->json($estoque, 201);  // Retorna o novo item criado com o status 201
    }

    // Atualiza um item de estoque existente
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'tipo_movimentacao' => 'required|string',
            'data_movimentacao' => 'required|date',
        ]);

        $itemEstoque = Estoque::findOrFail($id);
        $itemEstoque->update($validatedData);
        return response()->json($itemEstoque);
    }

    // Deleta um item de estoque
    public function destroy($id)
    {
        $itemEstoque = Estoque::findOrFail($id);
        $itemEstoque->delete();
        return response()->json(null, 204);  // Retorna uma resposta 204 (Sem Conteúdo)
    }
}
