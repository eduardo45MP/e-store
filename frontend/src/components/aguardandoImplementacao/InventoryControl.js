// src/components/InventoryControl.js
import React, { useEffect, useState } from 'react';
import api from '../axiosConfig';

const InventoryControl = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    api.get('/products')
      .then(response => {
        setProducts(response.data);
      })
      .catch(error => {
        console.error('Erro ao buscar produtos:', error);
      });
  }, []);

  const updateStock = (productId, newStock) => {
    api.put(`/products/${productId}`, { stock: newStock })
      .then(response => {
        alert('Estoque atualizado com sucesso!');
      })
      .catch(error => {
        console.error('Erro ao atualizar estoque:', error);
      });
  };

  return (
    <div>
      <h1>Controle de Estoque</h1>
      <ul>
        {products.map(product => (
          <li key={product.id}>
            {product.name} - Estoque: {product.stock}
            <button onClick={() => updateStock(product.id, product.stock - 1)}>
              Reduzir Estoque
            </button>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default InventoryControl;
