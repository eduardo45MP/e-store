import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Produto() {
    const [produtos, setProdutos] = useState([]);
    const [form, setForm] = useState({
        name: '',
        price: '',
        description: '',
        stock: '',
    });
    const [editing, setEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    // Carrega a lista de produtos ao iniciar
    useEffect(() => {
        fetchProdutos();
    }, []);

    // Função para buscar todos os produtos
    const fetchProdutos = async () => {
        try {
            const response = await axios.get('/products');
            setProdutos(response.data);
        } catch (error) {
            console.error('Erro ao carregar os produtos:', error);
        }
    };

    // Função para lidar com alterações no formulário
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Função para criar ou atualizar um produto
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editing) {
                await axios.put(`/products/${currentId}`, form);
            } else {
                await axios.post('/products', form);
            }
            setForm({ name: '', price: '', description: '', stock: '' });
            setEditing(false);
            fetchProdutos();
        } catch (error) {
            console.error('Erro ao salvar o produto:', error);
        }
    };

    // Função para editar um produto existente
    const handleEdit = (produto) => {
        setForm({
            name: produto.name,
            price: produto.price,
            description: produto.description,
            stock: produto.stock,
        });
        setCurrentId(produto.id);
        setEditing(true);
    };

    // Função para excluir um produto
    const handleDelete = async (id) => {
        try {
            await axios.delete(`/products/${id}`);
            fetchProdutos();
        } catch (error) {
            console.error('Erro ao excluir o produto:', error);
        }
    };

    return (
        <div>
            <h1>Produtos</h1>

            {/* Formulário para adicionar ou editar produto */}
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Nome:</label>
                    <input
                        type="text"
                        name="name"
                        value={form.name}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div>
                    <label>Preço:</label>
                    <input
                        type="number"
                        name="price"
                        value={form.price}
                        onChange={handleChange}
                        step="0.01"
                        required
                    />
                </div>
                <div>
                    <label>Descrição:</label>
                    <textarea
                        name="description"
                        value={form.description}
                        onChange={handleChange}
                    ></textarea>
                </div>
                <div>
                    <label>Estoque:</label>
                    <input
                        type="number"
                        name="stock"
                        value={form.stock}
                        onChange={handleChange}
                        required
                    />
                </div>
                <button type="submit">{editing ? 'Atualizar Produto' : 'Adicionar Produto'}</button>
            </form>

            {/* Lista de produtos */}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Descrição</th>
                        <th>Estoque</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {produtos.map((produto) => (
                        <tr key={produto.id}>
                            <td>{produto.id}</td>
                            <td>{produto.name}</td>
                            <td>{produto.price}</td>
                            <td>{produto.description}</td>
                            <td>{produto.stock}</td>
                            <td>
                                <button onClick={() => handleEdit(produto)}>Editar</button>
                                <button onClick={() => handleDelete(produto.id)}>Excluir</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Produto;
