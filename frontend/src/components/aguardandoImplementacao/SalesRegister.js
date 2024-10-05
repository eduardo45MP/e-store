// src/components/SalesRegister.js
import React, { useState } from 'react';
import api from '../axiosConfig';

const SalesRegister = () => {
  const [productId, setProductId] = useState('');
  const [quantity, setQuantity] = useState(1);

  const handleSale = () => {
    api.post('/sales', { product_id: productId, quantity })
      .then(response => {
        alert('Venda registrada com sucesso!');
      })
      .catch(error => {
        console.error('Erro ao registrar venda:', error);
      });
  };

  return (
    <div>
      <h1>Registro de Vendas</h1>
      <input 
        type="text" 
        placeholder="ID do Produto" 
        value={productId} 
        onChange={(e) => setProductId(e.target.value)} 
      />
      <input 
        type="number" 
        placeholder="Quantidade" 
        value={quantity} 
        onChange={(e) => setQuantity(e.target.value)} 
      />
      <button onClick={handleSale}>Registrar Venda</button>
    </div>
  );
};

export default SalesRegister;
