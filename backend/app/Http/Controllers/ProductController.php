<?php
// app/Http/Controllers/ProductController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Assumindo que o modelo Produto existe

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
            'nome' => 'required|string|max:255',        // Alterado para 'nome'
            'preco' => 'required|numeric|min:0',        // Alterado para 'preco'
            'descricao' => 'nullable|string',            // Alterado para 'descricao'
            'estoque' => 'required|integer|min:0',      // Alterado para 'estoque'
        ]);

        // Cria o novo produto no banco de dados
        Produto::create([
            'nome' => $request->input('nome'),         // Alterado para 'nome'
            'preco' => $request->input('preco'),       // Alterado para 'preco'
            'descricao' => $request->input('descricao'), // Alterado para 'descricao'
            'estoque' => $request->input('estoque'),    // Alterado para 'estoque'
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
            'nome' => 'required|string|max:255',       // Alterado para 'nome'
            'preco' => 'required|numeric|min:0',       // Alterado para 'preco'
            'descricao' => 'nullable|string',           // Alterado para 'descricao'
            'estoque' => 'required|integer|min:0',     // Alterado para 'estoque'
        ]);

        // Busca o produto pelo ID
        $product = Produto::findOrFail($id);

        // Atualiza os dados do produto
        $product->update([
            'nome' => $request->input('nome'),         // Alterado para 'nome'
            'preco' => $request->input('preco'),       // Alterado para 'preco'
            'descricao' => $request->input('descricao'), // Alterado para 'descricao'
            'estoque' => $request->input('estoque'),    // Alterado para 'estoque'
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
