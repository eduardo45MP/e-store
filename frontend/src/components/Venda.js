import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Venda() {
    const [vendas, setVendas] = useState([]);
    const [form, setForm] = useState({
        cliente: '',
        valor_total: '',
        data: '',
    });
    const [editing, setEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    // Carrega a lista de vendas ao iniciar
    useEffect(() => {
        fetchVendas();
    }, []);

    // Função para buscar todas as vendas
    const fetchVendas = async () => {
        try {
            const response = await axios.get('/vendas');
            setVendas(response.data);
        } catch (error) {
            console.error('Erro ao carregar as vendas:', error);
        }
    };

    // Função para lidar com alterações no formulário
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Função para criar ou atualizar uma venda
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editing) {
                await axios.put(`/vendas/${currentId}`, form);
            } else {
                await axios.post('/vendas', form);
            }
            setForm({ cliente: '', valor_total: '', data: '' });
            setEditing(false);
            fetchVendas();
        } catch (error) {
            console.error('Erro ao salvar a venda:', error);
        }
    };

    // Função para editar uma venda existente
    const handleEdit = (venda) => {
        setForm({
            cliente: venda.cliente,
            valor_total: venda.valor_total,
            data: venda.data,
        });
        setCurrentId(venda.id);
        setEditing(true);
    };

    // Função para excluir uma venda
    const handleDelete = async (id) => {
        try {
            await axios.delete(`/vendas/${id}`);
            fetchVendas();
        } catch (error) {
            console.error('Erro ao excluir a venda:', error);
        }
    };

    return (
        <div>
            <h1>Gerenciamento de Vendas</h1>

            {/* Formulário para adicionar ou editar uma venda */}
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Cliente:</label>
                    <input
                        type="text"
                        name="cliente"
                        value={form.cliente}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div>
                    <label>Valor Total:</label>
                    <input
                        type="number"
                        name="valor_total"
                        value={form.valor_total}
                        onChange={handleChange}
                        step="0.01"
                        required
                    />
                </div>
                <div>
                    <label>Data:</label>
                    <input
                        type="date"
                        name="data"
                        value={form.data}
                        onChange={handleChange}
                        required
                    />
                </div>
                <button type="submit">{editing ? 'Atualizar Venda' : 'Adicionar Venda'}</button>
            </form>

            {/* Lista de vendas */}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {vendas.map((venda) => (
                        <tr key={venda.id}>
                            <td>{venda.id}</td>
                            <td>{venda.cliente}</td>
                            <td>{venda.valor_total}</td>
                            <td>{venda.data}</td>
                            <td>
                                <button onClick={() => handleEdit(venda)}>Editar</button>
                                <button onClick={() => handleDelete(venda.id)}>Excluir</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Venda;
