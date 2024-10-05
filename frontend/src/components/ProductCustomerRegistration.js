// src/components/ProductCustomerRegistration.js
import React, { useState } from 'react';
import api from '../axiosConfig';

const ProductCustomerRegistration = () => {
  const [productName, setProductName] = useState('');
  const [productPrice, setProductPrice] = useState('');
  const [customerName, setCustomerName] = useState('');

  const handleProductSubmit = () => {
    api.post('/products', { name: productName, price: productPrice })
      .then(response => {
        alert('Produto cadastrado com sucesso!');
      })
      .catch(error => {
        console.error('Erro ao cadastrar produto:', error);
      });
  };

  const handleCustomerSubmit = () => {
    api.post('/customers', { name: customerName })
      .then(response => {
        alert('Cliente cadastrado com sucesso!');
      })
      .catch(error => {
        console.error('Erro ao cadastrar cliente:', error);
      });
  };

  return (
    <div>
      <h1>Cadastro de Produtos e Clientes</h1>

      {/* Formulário para cadastrar produtos */}
      <div>
        <h2>Cadastrar Produto</h2>
        <input 
          type="text" 
          placeholder="Nome do Produto" 
          value={productName} 
          onChange={(e) => setProductName(e.target.value)} 
        />
        <input 
          type="number" 
          placeholder="Preço do Produto" 
          value={productPrice} 
          onChange={(e) => setProductPrice(e.target.value)} 
        />
        <button onClick={handleProductSubmit}>Cadastrar Produto</button>
      </div>

      {/* Formulário para cadastrar clientes */}
      <div>
        <h2>Cadastrar Cliente</h2>
        <input 
          type="text" 
          placeholder="Nome do Cliente" 
          value={customerName} 
          onChange={(e) => setCustomerName(e.target.value)} 
        />
        <button onClick={handleCustomerSubmit}>Cadastrar Cliente</button>
      </div>
    </div>
  );
};

export default ProductCustomerRegistration;
