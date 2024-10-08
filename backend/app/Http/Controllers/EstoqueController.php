<?php
//app/Http/Controllers/EstoqueController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto; // Supondo que você tenha um modelo Produto

class EstoqueController extends Controller
{
    // Método para listar todos os produtos em estoque
    public function index()
    {
        $produtos = Produto::all(); // Busca todos os produtos no banco de dados
        return view('estoque.index', compact('produtos')); // Passa os produtos para a view
    }

    // Método para mostrar o formulário de criação de um novo produto
    public function create()
    {
        return view('estoque.create'); // Retorna a view de criação
    }

    // Método para armazenar um novo produto
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string|max:500', // Adicione a validação para descrição
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        // Criação de um novo produto
        Produto::create($request->all());

        // Redireciona de volta para o índice com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Produto adicionado com sucesso!');
    }

    // Método para mostrar o formulário de edição de um produto existente
    public function edit($id)
    {
        $produto = Produto::findOrFail($id); // Busca o produto pelo ID
        return view('estoque.edit', compact('produto')); // Retorna a view de edição
    }

    // Método para atualizar um produto existente
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
        ]);

        // Busca o produto e atualiza os dados
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());

        // Redireciona de volta para o índice com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Produto atualizado com sucesso!');
    }

    // Método para deletar um produto
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete(); // Deleta o produto

        // Redireciona de volta para o índice com uma mensagem de sucesso
        return redirect()->route('estoque.index')->with('success', 'Produto removido com sucesso!');
    }
}
