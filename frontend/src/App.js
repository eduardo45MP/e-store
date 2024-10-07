//src/App.js
import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Estoque from './components/Estoque';
import ItemVenda from './components/ItemVenda';
import Produto from './components/Produto';
import Usuario from './components/Usuario';
import Venda from './components/Venda';
import Home from "./components/Home"
import './styles/style.css'; // Importa o CSS global

function App() {
    console.log('App component rendered'); // Log ao renderizar o componente App

    return (
        <Router>
            <div>
                <header>
                    <h1>Bem-vindo à e-Store</h1>
                    <p>Escolha uma das opções abaixo para navegar:</p>
                </header>

                <main>
                    {/* Links para as páginas */}
                    <div className="menu">
                        <Link to="/estoque">
                            <button onClick={() => console.log('Navigating to Estoque')}>Estoque</button>
                        </Link>
                        <Link to="/item-venda">
                            <button onClick={() => console.log('Navigating to Item Venda')}>Item Venda</button>
                        </Link>
                        <Link to="/produto">
                            <button onClick={() => console.log('Navigating to Produto')}>Produto</button>
                        </Link>
                        <Link to="/usuario">
                            <button onClick={() => console.log('Navigating to Usuário')}>Usuário</button>
                        </Link>
                        <Link to="/venda">
                            <button onClick={() => console.log('Navigating to Venda')}>Venda</button>
                        </Link>
                    </div>

                    {/* Rotas que serão exibidas ao clicar nos botões */}
                    <Routes>
                        <Route path="/" element={<Home />} />
                        <Route path="/estoque" element={<Estoque />} />
                        <Route path="/item-venda" element={<ItemVenda />} />
                        <Route path="/produto" element={<Produto />} />
                        <Route path="/usuario" element={<Usuario />} />
                        <Route path="/venda" element={<Venda />} />
                    </Routes>
                </main>

                <footer>
                    <p>&copy; 2024 e-Store</p>
                </footer>
            </div>
        </Router>
    );
}

export default App;
