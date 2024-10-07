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
    const [loading, setLoading] = useState(true); // Novo estado para carregar
    const [error, setError] = useState(null); // Novo estado para erros

    // Função para carregar o estoque ao iniciar
    useEffect(() => {
        console.log('Componente montado, buscando estoque...');
        fetchEstoque();
    }, []);

    // Função para buscar os itens do estoque
    const fetchEstoque = async () => {
        setLoading(true); // Inicia o carregamento
        console.log('Buscando itens de estoque...');
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/estoque');
            console.log('Resposta recebida:', response.data);
            setItensEstoque(response.data);
            setError(null); // Reseta o erro se a requisição for bem-sucedida
        } catch (error) {
            console.error('Erro ao carregar o estoque:', error);
            setError('Erro ao carregar o estoque. Tente novamente mais tarde.');
        } finally {
            setLoading(false); // Finaliza o carregamento
        }
    };

    // Função para lidar com a alteração nos inputs do formulário
    const handleChange = (e) => {
        console.log('Campo alterado:', e.target.name, 'Valor:', e.target.value);
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Função para enviar o formulário (Criar ou Atualizar)
    const handleSubmit = async (e) => {
        e.preventDefault();
        console.log('Formulário enviado, dados:', form);
        try {
            if (editing) {
                console.log(`Atualizando item ID: ${currentId}`);
                await axios.put(`http://127.0.0.1:8000/api/estoque/${currentId}`, form, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
            } else {
                console.log('Adicionando novo item...');
                await axios.post('http://127.0.0.1:8000/api/estoque', form, {
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
            }
            console.log('Operação de sucesso');
            setForm({ produto_id: '', quantidade: '', tipo_movimentacao: '', data_movimentacao: '' });
            setEditing(false);
            fetchEstoque(); // Recarrega a lista após operação
        } catch (error) {
            console.error('Erro ao salvar o item de estoque:', error);
            setError('Erro ao salvar o item. Tente novamente.');
        }
    };

    // Função para editar um item
    const handleEdit = (item) => {
        console.log('Editando item:', item);
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
        if (window.confirm('Tem certeza que deseja excluir este item?')) {
            console.log(`Excluindo item ID: ${id}`);
            try {
                await axios.delete(`http://127.0.0.1:8000/api/estoque/${id}`);
                fetchEstoque();
            } catch (error) {
                console.error('Erro ao excluir o item:', error);
                setError('Erro ao excluir o item. Tente novamente.');
            }
        }
    };

    return (
        <div>
            <h1>Estoque</h1>

            {/* Mensagem de erro */}
            {error && <p style={{ color: 'red' }}>{error}</p>}

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

            {/* Mensagem de carregamento */}
            {loading ? (
                <p>Carregando...</p>
            ) : (
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
            )}
        </div>
    );
}

export default Estoque;
