import React, { useState, useEffect } from 'react';
import axios from 'axios';

function Usuario() {
    const [usuarios, setUsuarios] = useState([]);
    const [form, setForm] = useState({
        name: '',
        email: '',
        password: '',
    });
    const [editing, setEditing] = useState(false);
    const [currentId, setCurrentId] = useState(null);

    // Carrega a lista de usuários ao iniciar
    useEffect(() => {
        fetchUsuarios();
    }, []);

    // Função para buscar todos os usuários
    const fetchUsuarios = async () => {
        try {
            const response = await axios.get('/usuarios');
            setUsuarios(response.data);
        } catch (error) {
            console.error('Erro ao carregar os usuários:', error);
        }
    };

    // Função para lidar com alterações no formulário
    const handleChange = (e) => {
        setForm({
            ...form,
            [e.target.name]: e.target.value,
        });
    };

    // Função para criar ou atualizar um usuário
    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            if (editing) {
                await axios.put(`/usuarios/${currentId}`, form);
            } else {
                await axios.post('/usuarios', form);
            }
            setForm({ name: '', email: '', password: '' });
            setEditing(false);
            fetchUsuarios();
        } catch (error) {
            console.error('Erro ao salvar o usuário:', error);
        }
    };

    // Função para editar um usuário existente
    const handleEdit = (usuario) => {
        setForm({
            name: usuario.name,
            email: usuario.email,
            password: '', // Não exibe a senha por questões de segurança
        });
        setCurrentId(usuario.id);
        setEditing(true);
    };

    // Função para excluir um usuário
    const handleDelete = async (id) => {
        try {
            await axios.delete(`/usuarios/${id}`);
            fetchUsuarios();
        } catch (error) {
            console.error('Erro ao excluir o usuário:', error);
        }
    };

    return (
        <div>
            <h1>Gerenciamento de Usuários</h1>

            {/* Formulário para adicionar ou editar usuário */}
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
                    <label>Email:</label>
                    <input
                        type="email"
                        name="email"
                        value={form.email}
                        onChange={handleChange}
                        required
                    />
                </div>
                <div>
                    <label>Senha:</label>
                    <input
                        type="password"
                        name="password"
                        value={form.password}
                        onChange={handleChange}
                        required={!editing} // Senha obrigatória apenas ao criar
                    />
                </div>
                <button type="submit">{editing ? 'Atualizar Usuário' : 'Adicionar Usuário'}</button>
            </form>

            {/* Lista de usuários */}
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {usuarios.map((usuario) => (
                        <tr key={usuario.id}>
                            <td>{usuario.id}</td>
                            <td>{usuario.name}</td>
                            <td>{usuario.email}</td>
                            <td>
                                <button onClick={() => handleEdit(usuario)}>Editar</button>
                                <button onClick={() => handleDelete(usuario.id)}>Excluir</button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
}

export default Usuario;
