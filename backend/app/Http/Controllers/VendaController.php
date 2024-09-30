<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda; // Certifique-se de que o modelo Venda existe

class VendaController extends Controller
{
    // Função para listar todas as vendas
    public function index()
    {
        // Busca todas as vendas no banco de dados
        $vendas = Venda::all();

        // Retorna a view de listagem de vendas passando a lista de vendas
        return view('vendas.index', compact('vendas'));
    }

    // Função para exibir uma venda específica
    public function show($id)
    {
        // Busca a venda pelo ID
        $venda = Venda::findOrFail($id);

        // Retorna a view de exibição da venda, passando os dados da venda
        return view('vendas.show', compact('venda'));
    }

    // Função para exibir o formulário de criação de uma nova venda
    public function create()
    {
        // Retorna a view de criação de venda
        return view('vendas.create');
    }

    // Função para salvar uma nova venda
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'cliente' => 'required|string|max:255',
            'valor_total' => 'required|numeric',
            'data' => 'required|date',
        ]);

        // Criação de uma nova venda no banco de dados
        Venda::create([
            'cliente' => $request->input('cliente'),
            'valor_total' => $request->input('valor_total'),
            'data' => $request->input('data'),
        ]);

        // Redireciona para a lista de vendas com uma mensagem de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda criada com sucesso!');
    }

    // Função para exibir o formulário de edição de uma venda específica
    public function edit($id)
    {
        // Busca a venda pelo ID
        $venda = Venda::findOrFail($id);

        // Retorna a view de edição, passando os dados da venda
        return view('vendas.edit', compact('venda'));
    }

    // Função para atualizar os dados de uma venda
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'cliente' => 'required|string|max:255',
            'valor_total' => 'required|numeric',
            'data' => 'required|date',
        ]);

        // Busca a venda pelo ID
        $venda = Venda::findOrFail($id);

        // Atualiza os dados da venda
        $venda->update([
            'cliente' => $request->input('cliente'),
            'valor_total' => $request->input('valor_total'),
            'data' => $request->input('data'),
        ]);

        // Redireciona para a lista de vendas com uma mensagem de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    // Função para excluir uma venda
    public function destroy($id)
    {
        // Busca a venda pelo ID
        $venda = Venda::findOrFail($id);

        // Exclui a venda
        $venda->delete();

        // Redireciona para a lista de vendas com uma mensagem de sucesso
        return redirect()->route('vendas.index')->with('success', 'Venda excluída com sucesso!');
    }
}
