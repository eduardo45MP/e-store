{{-- resources/views/item_venda/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Itens de Venda</h1>

        {{-- Exibe mensagens de sucesso --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Botão para adicionar um novo item de venda --}}
        <a href="{{ route('item_venda.create') }}" class="btn btn-primary mb-3">Adicionar Item de Venda</a>

        {{-- Tabela para listar os itens de venda --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Venda</th>
                    <th>Quantidade</th>
                    <th>Preço Unitário</th>
                    <th>Subtotal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itensVenda as $item)
                    <tr>
                        <td>{{ $item->id }}</td>

                        {{-- Nome do produto relacionado --}}
                        <td>{{ $item->produto->nome }}</td>

                        {{-- Identificador da venda relacionada --}}
                        <td>{{ $item->venda->id }}</td>

                        {{-- Quantidade do item --}}
                        <td>{{ $item->quantidade }}</td>

                        {{-- Preço unitário --}}
                        <td>R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</td>

                        {{-- Subtotal calculado (quantidade * preço unitário) --}}
                        <td>R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}</td>

                        {{-- Ações para editar ou excluir o item de venda --}}
                        <td>
                            <a href="{{ route('item_venda.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('item_venda.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
