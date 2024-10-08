<!DOCTYPE html>
<!-- resources/views/products/create.blade.php -->
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - e-Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-primary text-white text-center py-5">
        <h1>Cadastrar Produto</h1>
        <p>Preencha os dados do produto abaixo.</p>
    </header>

    <div class="container mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Produto:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Preço:</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Quantidade em Estoque:</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar Produto</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

    <footer class="bg-light text-center py-4">
        <p>&copy; 2024 e-Store. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
