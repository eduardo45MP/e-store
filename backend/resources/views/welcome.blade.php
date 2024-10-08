<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Store - Sistema de Gestão para Lojas</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Estilos personalizados para a landing page */
        .hero {
            background-color: #f8fafc;
            padding: 60px 20px;
            text-align: center;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin: 40px 0;
        }
        .feature {
            border: 1px solid #e5e7eb;
            padding: 20px;
            border-radius: 8px;
            width: 30%;
            text-align: center;
        }
        .cta {
            background-color: #2563eb;
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
        }
        .cta:hover {
            background-color: #1e40af;
        }
    </style>
</head>
<body>
    <header class="hero">
        <h1>Bem-vindo ao e-Store</h1>
        <p>O sistema de gestão ideal para micro, pequenas e médias empresas.</p>
        <a href="{{ route('register') }}" class="cta">Comece agora!</a>
    </header>

    <section class="features">
        <div class="feature">
            <h2>Gerenciamento de Produtos</h2>
            <p>Adicione, edite e remova produtos com facilidade.</p>
        </div>
        <div class="feature">
            <h2>Controle de Estoque</h2>
            <p>Monitore seu estoque em tempo real e evite faltas.</p>
        </div>
        <div class="feature">
            <h2>Carrinho de Compras</h2>
            <p>Experiência de compra simplificada para seus clientes.</p>
        </div>
    </section>

    <footer>
        <div class="text-center">
            <p>&copy; {{ date('Y') }} e-Store. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
