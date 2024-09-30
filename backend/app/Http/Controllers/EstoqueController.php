<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estoque;

class EstoqueController extends Controller
{
    public function index()
    {
    // Obtém todos os itens de estoque
    $itensEstoque = Estoque::with('produto')->get(); // Inclui as informações do produto

    return view('estoque.index', compact('itensEstoque'));
    }

    public function show($id)
    {
        // Obtém um item de estoque específico
        $itemEstoque = Estoque::with('produto')->findOrFail($id); // Utiliza findOrFail para lidar com o caso em que o item não existe
    
        return view('estoque.show', compact('itemEstoque'));
    }    

    public function create()
    {
        // Exibe o formulário de criação de item de estoque
        return view('estoque.create');
    }    

    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'tipo_movimentacao' => 'required|string',
            'data_movimentacao' => 'required|date',
        ]);
    
        // Cria um novo item de estoque
        Estoque::create($request->all());
    
        // Redireciona para a lista de itens de estoque com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Item de estoque criado com sucesso.');
    }    

    public function edit($id)
    {
        // Obtém um item de estoque específico para edição
        $itemEstoque = Estoque::findOrFail($id);
    
        return view('estoque.edit', compact('itemEstoque'));
    }    

    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'tipo_movimentacao' => 'required|string',
            'data_movimentacao' => 'required|date',
        ]);
    
        // Obtém o item de estoque específico e atualiza
        $itemEstoque = Estoque::findOrFail($id);
        $itemEstoque->update($request->all());
    
        // Redireciona para a lista de itens de estoque com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Item de estoque atualizado com sucesso.');
    }    

    public function destroy($id)
    {
        // Obtém o item de estoque específico e exclui
        $itemEstoque = Estoque::findOrFail($id);
        $itemEstoque->delete();
    
        // Redireciona para a lista de itens de estoque com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Item de estoque excluído com sucesso.');
    }    
}
