{{-- resources/views/estoque/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('estoque.update', $produto->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                            <input type="text" name="nome" id="nome" value="{{ $produto->nome }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                        </div>
                        <div class="mb-4">
                            <label for="quantidade" class="block text-sm font-medium text-gray-700">Quantidade</label>
                            <input type="number" name="quantidade" id="quantidade" value="{{ $produto->quantidade }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required min="0">
                        </div>
                        <div class="mb-4">
                            <label for="preco" class="block text-sm font-medium text-gray-700">Preço</label>
                            <input type="number" name="preco" id="preco" value="{{ $produto->preco }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required min="0" step="0.01">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar Produto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
