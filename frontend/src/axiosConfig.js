// src/axiosConfig.js
import axios from 'axios';

// Configuração do Axios para incluir o token CSRF
console.log('Iniciando configuração do Axios...');
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : null;
if (csrfToken) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
  console.log('Token CSRF encontrado e configurado:', csrfToken);
} else {
  console.warn('Token CSRF não encontrado!');
}

// Cria uma instância do axios com a URL base do backend Laravel
const api = axios.create({
  baseURL: process.env.API_BASE_URL || 'http://127.0.0.1:8000/',
  headers: {
    'Content-Type': 'application/json',
  },
});

console.log('Instância Axios criada com a URL base:', api.defaults.baseURL);

// Interceptor para adicionar o token CSRF a cada requisição
api.interceptors.request.use(config => {
  const csrfTokenElement = document.querySelector('meta[name="csrf-token"]');
  if (csrfTokenElement) {
    config.headers['X-CSRF-TOKEN'] = csrfTokenElement.content;
    console.log('Token CSRF adicionado à requisição:', csrfTokenElement.content);
  } else {
    console.warn('Token CSRF não encontrado ao configurar a requisição!');
  }

  console.log('Configuração da requisição antes do envio:', config);
  return config;
}, error => {
  console.error('Erro ao configurar a requisição:', error);
  return Promise.reject(error);
});

// Interceptor para tratar erros
api.interceptors.response.use(
  response => {
    console.log('Resposta recebida:', response);
    return response;
  },
  error => {
    if (error.response) {
      // O servidor respondeu com um status diferente de 2xx
      console.error('Erro na resposta:', {
        status: error.response.status,
        data: error.response.data,
        headers: error.response.headers,
      });
    } else if (error.request) {
      // A requisição foi feita, mas nenhuma resposta foi recebida
      console.error('Nenhuma resposta recebida. Detalhes da requisição:', error.request);
    } else {
      // Algum outro erro ocorreu ao configurar a requisição
      console.error('Erro ao configurar a requisição:', error.message);
    }
    return Promise.reject(error);
  }
);

export default api;
