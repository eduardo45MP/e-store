// src/components/Estoque.js
import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Estoque() {
    const [itensEstoque, setItensEstoque] = useState([]);
    const [form, setForm] = useState({
        produto_id: '',
        quantidade: '',
        tipo_movimentacao: '',
        data_movimentacao: '',
    });
    const [editing, setEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    // Função para carregar o estoque ao iniciar
    useEffect(() => {
        fetchEstoque();
    }, []);

    // Função para buscar os itens do estoque
    const fetchEstoque = async () => {
        try {
            const response = await axios.get('/estoque'); // Altere para o caminho correto da sua API
            setItensEstoque(response.data);
        } catch (error) {
            console.error('Erro ao carregar o estoque:', error);
        }
    };

    // Função para lidar com a alteração nos inputs do formulário
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
                await axios.put(`/estoque/${currentId}`, form); // Atualiza item
            } else {
                await axios.post('/estoque', form); // Cria novo item
            }
            setForm({ produto_id: '', quantidade: '', tipo_movimentacao: '', data_movimentacao: '' });
            setEditing(false);
            fetchEstoque();
        } catch (error) {
            console.error('Erro ao salvar o item de estoque:', error);
        }
    };

    // Função para editar um item
    const handleEdit = (item) => {
        setForm({
            produto_id: item.produto_id,
            quantidade: item.quantidade,
            tipo_movimentacao: item.tipo_movimentacao,
            data_movimentacao: item.data_movimentacao,
        });
        setCurrentId(item.id);
        setEditing(true);
    };

    // Função para deletar um item
    const handleDelete = async (id) => {
        try {
            await axios.delete(`/estoque/${id}`);
            fetchEstoque();
        } catch (error) {
            console.error('Erro ao excluir o item:', error);
        }
    };

    return (
        <div>
            <h1>Estoque</h1>

            {/* Formulário para adicionar/editar itens de estoque */}
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Produto ID:</label>
                    <input
                        type="number"
                        name="produto_id"
                        value={form.produto_id}
                        onChange={handleChange}
                        required
                    />
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
                    <label>Tipo Movimentação:</label>
                    <input
                        type="text"
                        name="tipo_movimentacao"
                        value={form.tipo_movimentacao}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div>
                    <label>Data Movimentação:</label>
                    <input
                        type="date"
                        name="data_movimentacao"
                        value={form.data_movimentacao}
                        onChange={handleChange}
                        required
                    />
                </div>
                <button type="submit">{editing ? 'Atualizar Item' : 'Adicionar Item'}</button>
            </form>

            {/* Lista de itens de estoque */}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Tipo Movimentação</th>
                        <th>Data Movimentação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {itensEstoque.map((item) => (
                        <tr key={item.id}>
                            <td>{item.id}</td>
                            <td>{item.produto_id}</td>
                            <td>{item.quantidade}</td>
                            <td>{item.tipo_movimentacao}</td>
                            <td>{item.data_movimentacao}</td>
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

export default Estoque;
//Explicação:
//Estado:

//itensEstoque: Armazena os itens de estoque.
//form: Armazena os valores do formulário para criar/editar.
//editing: Indica se está no modo de edição.
//currentId: Armazena o ID do item que está sendo editado.
//Funções:

//fetchEstoque(): Carrega a lista de itens de estoque do backend.
//handleChange(): Atualiza os valores do formulário à medida que o usuário insere os dados.
//handleSubmit(): Envia os dados do formulário para criar ou atualizar um item de estoque.
//handleEdit(): Preenche o formulário com os dados de um item existente para edição.
//handleDelete(): Remove um item de estoque do banco de dados.
//Interface:

//Um formulário é usado para adicionar ou editar itens de estoque.
//A tabela exibe todos os itens de estoque e inclui botões de editar e excluir para cada item.
//Conexão com o Back-end:
//O Axios é utilizado para realizar requisições HTTP para o back-end Laravel (/estoque), onde ocorrem as operações de listar, criar, editar e deletar os itens de estoque.
//Próximos Passos:
//a. Adicionar tratamento de erros mais detalhado e mensagens de carregamento (loading).
//b. Adicionar paginação ou filtros à lista de itens, caso haja muitos dados a serem exibidos.