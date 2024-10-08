<?php
//app/Http/Controllers/ItemVendaController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemVenda;
use App\Models\Produto;
use App\Models\Venda;

class ItemVendaController extends Controller
{
    // Exibe a lista de itens de venda
    public function index()
    {
        // Obtém todos os itens de venda junto com seus produtos e vendas relacionados
        $itensVenda = ItemVenda::with('produto', 'venda')->get(); // Inclui informações do produto e da venda

        // Retorna para a view de listagem dos itens de venda
        return view('item_venda.index', compact('itensVenda'));
    }

    // Exibe um item de venda específico
    public function show($id)
    {
        // Obtém um item de venda específico com suas relações
        $itemVenda = ItemVenda::with('produto', 'venda')->findOrFail($id);

        // Retorna para a view de exibição do item de venda
        return view('item_venda.show', compact('itemVenda'));
    }

    // Exibe o formulário de criação de item de venda
    public function create()
    {
        // Pega todos os produtos e vendas disponíveis para o formulário
        $produtos = Produto::all();
        $vendas = Venda::all();

        // Retorna para a view de criação de item de venda
        return view('item_venda.create', compact('produtos', 'vendas'));
    }

    // Salva um novo item de venda
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'venda_id' => 'required|exists:vendas,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric|min:0.01',
        ]);

        // Cria o item de venda no banco de dados
        ItemVenda::create($request->all());

        // Redireciona de volta para a listagem com uma mensagem de sucesso
        return redirect()->route('item_venda.index')->with('success', 'Item de venda criado com sucesso.');
    }

    // Exibe o formulário de edição de item de venda
    public function edit($id)
    {
        // Obtém o item de venda específico
        $itemVenda = ItemVenda::findOrFail($id);

        // Obtém os produtos e vendas para seleção no formulário
        $produtos = Produto::all();
        $vendas = Venda::all();

        // Retorna para a view de edição do item de venda
        return view('item_venda.edit', compact('itemVenda', 'produtos', 'vendas'));
    }

    // Atualiza um item de venda específico
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'venda_id' => 'required|exists:vendas,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'preco_unitario' => 'required|numeric|min:0.01',
        ]);

        // Obtém o item de venda específico
        $itemVenda = ItemVenda::findOrFail($id);

        // Atualiza o item de venda com os novos dados
        $itemVenda->update($request->all());

        // Redireciona para a listagem com uma mensagem de sucesso
        return redirect()->route('item_venda.index')->with('success', 'Item de venda atualizado com sucesso.');
    }

    // Exclui um item de venda
    public function destroy($id)
    {
        // Obtém o item de venda específico
        $itemVenda = ItemVenda::findOrFail($id);

        // Exclui o item de venda
        $itemVenda->delete();

        // Redireciona para a listagem com uma mensagem de sucesso
        return redirect()->route('item_venda.index')->with('success', 'Item de venda excluído com sucesso.');
    }
}
