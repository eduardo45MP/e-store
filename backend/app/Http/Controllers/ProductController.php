<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Assumindo que o modelo Product existe

class ProductController extends Controller
{
    // Função para listar todos os produtos
    public function index()
    {
        // Obtém todos os produtos do banco de dados
        $products = Produto::all();

        // Retorna para a view de listagem dos produtos, passando a lista de produtos
        return view('products.index', compact('products'));
    }

    // Função para exibir um produto específico
    public function show($id)
    {
        // Busca o produto pelo ID
        $product = Produto::findOrFail($id);

        // Retorna para a view de exibição de produto, passando o produto encontrado
        return view('products.show', compact('product'));
    }

    // Função para exibir o formulário de criação de um novo produto
    public function create()
    {
        // Retorna para a view de criação de produto
        return view('products.create');
    }

    // Função para armazenar o produto criado
    public function store(Request $request)
    {
        // Validação dos dados enviados pelo formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        // Cria o novo produto no banco de dados
        Produto::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
        ]);

        // Redireciona de volta para a lista de produtos com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    // Função para exibir o formulário de edição de um produto existente
    public function edit($id)
    {
        // Busca o produto pelo ID
        $product = Produto::findOrFail($id);

        // Retorna para a view de edição de produto, passando o produto encontrado
        return view('products.edit', compact('product'));
    }

    // Função para atualizar um produto existente
    public function update(Request $request, $id)
    {
        // Validação dos dados enviados pelo formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'stock' => 'required|integer|min:0',
        ]);

        // Busca o produto pelo ID
        $product = Produto::findOrFail($id);

        // Atualiza os dados do produto
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
        ]);

        // Redireciona de volta para a lista de produtos com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Função para excluir um produto existente
    public function destroy($id)
    {
        // Busca o produto pelo ID
        $product = Produto::findOrFail($id);

        // Exclui o produto
        $product->delete();

        // Redireciona de volta para a lista de produtos com uma mensagem de sucesso
        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }
}
