// src/components/UserManagement.js
import React, { useEffect, useState } from 'react';
import api from '../axiosConfig';

const UserManagement = () => {
  const [users, setUsers] = useState([]);
  const [userName, setUserName] = useState('');
  const [userRole, setUserRole] = useState('user');

  useEffect(() => {
    api.get('/users')
      .then(response => {
        setUsers(response.data);
      })
      .catch(error => {
        console.error('Erro ao buscar usuários:', error);
      });
  }, []);

  const handleUserSubmit = () => {
    api.post('/users', { name: userName, role: userRole })
      .then(response => {
        alert('Usuário criado com sucesso!');
      })
      .catch(error => {
        console.error('Erro ao criar usuário:', error);
      });
  };

  return (
    <div>
      <h1>Gestão de Usuários</h1>
      <ul>
        {users.map(user => (
          <li key={user.id}>
            {user.name} - {user.role}
          </li>
        ))}
      </ul>

      <h2>Criar Novo Usuário</h2>
      <input 
        type="text" 
        placeholder="Nome do Usuário" 
        value={userName} 
        onChange={(e) => setUserName(e.target.value)} 
      />
      <select value={userRole} onChange={(e) => setUserRole(e.target.value)}>
        <option value="user">Usuário</option>
        <option value="admin">Administrador</option>
      </select>
      <button onClick={handleUserSubmit}>Criar Usuário</button>
    </div>
  );
};

export default UserManagement;
