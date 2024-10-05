// src/components/ProductList.js
import React, { useEffect, useState } from 'react';
import api from '../axiosConfig';

const ProductList = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    // Fazer a requisição ao backend para buscar os produtos
    api.get('/products')
      .then(response => {
        setProducts(response.data); // Atualiza o estado com a lista de produtos
      })
      .catch(error => {
        console.error('Erro ao buscar produtos:', error);
      });
  }, []); // O array vazio significa que o useEffect será executado apenas uma vez ao carregar o componente

  return (
    <div>
      <h1>Lista de Produtos</h1>
      <ul>
        {products.map(product => (
          <li key={product.id}>{product.name} - {product.price}</li>
        ))}
      </ul>
    </div>
  );
};

export default ProductList;
