// src/axiosConfig.js
import axios from 'axios';

const api = axios.create({
  baseURL: 'http://localhost:8000/api', // URL base do seu backend Laravel
  headers: {
    'Content-Type': 'application/json',
    // Adicione outros headers se necessário, como o token de autenticação
  }
});

export default api;
