<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Controle de Estoque') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-500 text-black p-4 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('estoque.create') }}" class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded">Adicionar Produto</a>
                    <table class="min-w-full divide-y divide-gray-200 mt-4">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($produtos as $produto)
                                <tr class="@if($produto->quantidade <= 5) bg-red-100 @endif">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $produto->nome }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $produto->quantidade }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($produto->preco, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap flex items-center space-x-2">
                                        <a href="{{ route('estoque.edit', $produto->id) }}" class="text-blue-600">Editar</a>
                                        <form action="{{ route('estoque.destroy', $produto->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja remover este produto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Remover</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
