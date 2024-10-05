// src/App.js
//import ProductList from './components/ProductList';
import React from 'react';
import './App.css';
import InventoryControl from './components/InventoryControl';
import SalesRegister from './components/SalesRegister';
import FinancialReports from './components/FinancialReports';
import ProductCustomerRegistration from './components/ProductCustomerRegistration';
import UserManagement from './components/UserManagement';

function App() {
  return (
    <div className="App">
      <h1>Administração da E-Store</h1>
      <InventoryControl />
      <SalesRegister />
      <FinancialReports />
      <ProductCustomerRegistration />
      <UserManagement />
    </div>
  );
}

export default App;
