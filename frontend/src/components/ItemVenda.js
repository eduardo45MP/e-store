import React, { useState, useEffect } from 'react';
import axios from 'axios';

function ItemVenda() {
    const [itensVenda, setItensVenda] = useState([]);
    const [produtos, setProdutos] = useState([]);
    const [vendas, setVendas] = useState([]);
    const [form, setForm] = useState({
        venda_id: '',
        produto_id: '',
        quantidade: '',
        preco_unitario: '',
    });
    const [editing, setEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    // Carrega os itens de venda e opções de produtos e vendas ao iniciar
    useEffect(() => {
        fetchItensVenda();
        fetchProdutos();
        fetchVendas();
    }, []);

    // Função para buscar todos os itens de venda
    const fetchItensVenda = async () => {
        try {
            const response = await axios.get('/item_venda');
            setItensVenda(response.data);
        } catch (error) {
            console.error('Erro ao carregar itens de venda:', error);
        }
    };

    // Função para buscar todos os produtos
    const fetchProdutos = async () => {
        try {
            const response = await axios.get('/produtos');
            setProdutos(response.data);
        } catch (error) {
            console.error('Erro ao carregar produtos:', error);
        }
    };

    // Função para buscar todas as vendas
    const fetchVendas = async () => {
        try {
            const response = await axios.get('/vendas');
            setVendas(response.data);
        } catch (error) {
            console.error('Erro ao carregar vendas:', error);
        }
    };

    // Função para lidar com as mudanças no formulário
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Função para enviar o formulário (Criar ou Atualizar)
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editing) {
                await axios.put(`/item_venda/${currentId}`, form);
            } else {
                await axios.post('/item_venda', form);
            }
            setForm({ venda_id: '', produto_id: '', quantidade: '', preco_unitario: '' });
            setEditing(false);
            fetchItensVenda();
        } catch (error) {
            console.error('Erro ao salvar o item de venda:', error);
        }
    };

    // Função para editar um item
    const handleEdit = (item) => {
        setForm({
            venda_id: item.venda_id,
            produto_id: item.produto_id,
            quantidade: item.quantidade,
            preco_unitario: item.preco_unitario,
        });
        setCurrentId(item.id);
        setEditing(true);
    };

    // Função para excluir um item de venda
    const handleDelete = async (id) => {
        try {
            await axios.delete(`/item_venda/${id}`);
            fetchItensVenda();
        } catch (error) {
            console.error('Erro ao excluir item de venda:', error);
        }
    };

    return (
        <div>
            <h1>Itens de Venda</h1>

            {/* Formulário para adicionar/editar itens de venda */}
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Venda:</label>
                    <select
                        name="venda_id"
                        value={form.venda_id}
                        onChange={handleChange}
                        required
                    >
                        <option value="">Selecione a venda</option>
                        {vendas.map((venda) => (
                            <option key={venda.id} value={venda.id}>
                                {venda.id} - {venda.nome_cliente}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label>Produto:</label>
                    <select
                        name="produto_id"
                        value={form.produto_id}
                        onChange={handleChange}
                        required
                    >
                        <option value="">Selecione o produto</option>
                        {produtos.map((produto) => (
                            <option key={produto.id} value={produto.id}>
                                {produto.nome}
                            </option>
                        ))}
                    </select>
                </div>
                <div>
                    <label>Quantidade:</label>
                    <input
                        type="number"
                        name="quantidade"
                        value={form.quantidade}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div>
                    <label>Preço Unitário:</label>
                    <input
                        type="number"
                        name="preco_unitario"
                        value={form.preco_unitario}
                        onChange={handleChange}
                        step="0.01"
                        required
                    />
                </div>
                <button type="submit">{editing ? 'Atualizar Item' : 'Adicionar Item'}</button>
            </form>

            {/* Lista de itens de venda */}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Venda</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {itensVenda.map((item) => (
                        <tr key={item.id}>
                            <td>{item.id}</td>
                            <td>{item.venda_id}</td>
                            <td>{item.produto.nome}</td>
                            <td>{item.quantidade}</td>
                            <td>{item.preco_unitario}</td>
                            <td>
                                <button onClick={() => handleEdit(item)}>Editar</button>
                                <button onClick={() => handleDelete(item.id)}>Excluir</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default ItemVenda;
/*Explicação:
Estado:

itensVenda: Armazena os itens de venda.
produtos: Lista de produtos disponíveis para a seleção.
vendas: Lista de vendas disponíveis para a seleção.
form: Gerencia os valores do formulário para criar ou editar um item de venda.
editing: Controla se o formulário está no modo de edição.
currentId: Armazena o ID do item de venda que está sendo editado.
Funções:

fetchItensVenda(): Obtém todos os itens de venda do back-end.
fetchProdutos(): Obtém todos os produtos disponíveis para associar ao item de venda.
fetchVendas(): Obtém todas as vendas disponíveis para associar ao item de venda.
handleChange(): Atualiza os valores do formulário quando o usuário faz uma alteração.
handleSubmit(): Envia os dados do formulário para criar ou atualizar um item de venda.
handleEdit(): Preenche o formulário com os dados de um item para edição.
handleDelete(): Exclui um item de venda.
Formulário:

O formulário permite a criação e edição de itens de venda. Ele usa um select para selecionar os produtos e vendas disponíveis, com validações para garantir que os campos obrigatórios sejam preenchidos.
Tabela:

Exibe a lista de itens de venda cadastrados, com botões de editar e excluir para cada item.
Conexão com o Back-end:
O Axios é usado para realizar as requisições HTTP ao back-end Laravel, para criar, editar, listar e excluir itens de venda.
Próximos Passos:
a. Adicionar paginação na listagem dos itens de venda, se necessário.
b. Melhorar o tratamento de erros e feedback ao usuário (mensagens de erro, loading, etc.).*/