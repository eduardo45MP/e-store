import React from 'react';
import { BrowserRouter as Router, Route, Routes, Link } from 'react-router-dom';
import Estoque from './components/Estoque';
import ItemVenda from './components/ItemVenda';
import Produto from './components/Produto';
import Usuario from './components/Usuario';
import Venda from './components/Venda';
import './styles/style.css'; // Importa o CSS global

function App() {
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
                            <button>Estoque</button>
                        </Link>
                        <Link to="/item-venda">
                            <button>Item Venda</button>
                        </Link>
                        <Link to="/produto">
                            <button>Produto</button>
                        </Link>
                        <Link to="/usuario">
                            <button>Usuário</button>
                        </Link>
                        <Link to="/venda">
                            <button>Venda</button>
                        </Link>
                    </div>

                    {/* Rotas que serão exibidas ao clicar nos botões */}
                    <Routes>
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
