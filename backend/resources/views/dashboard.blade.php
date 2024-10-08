<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium">Bem-vindo ao e-Store!</h3>
                    <p>{{ __("Você está logado!") }}</p>
                    <p class="mt-4">Utilize as funcionalidades abaixo para gerenciar sua loja:</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        <!-- Controle de Estoque -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Controle de Estoque</h4>
                            <p>Gerencie seu estoque de produtos e evite faltas.</p>
                            <a href="{{ route('estoque.index') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>

                        <!-- Registro de Vendas -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Registro de Vendas</h4>
                            <p>Registre vendas rapidamente com nosso PDV integrado.</p>
                            <a href="{{ route('vendas.create') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>

                        <!-- Geração de Relatórios Financeiros -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Relatórios Financeiros</h4>
                            <p>Gere relatórios financeiros para análise de desempenho.</p>
                            <a href="{{ route('relatorios.index') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>

                        <!-- Cadastro de Produtos -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Cadastro de Produtos</h4>
                            <p>Cadastre e gerencie seus produtos de forma simples.</p>
                            <a href="{{ route('produtos.create') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>

                        <!-- Cadastro de Clientes -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Cadastro de Clientes</h4>
                            <p>Mantenha seu cadastro de clientes sempre atualizado.</p>
                            <a href="{{ route('clientes.create') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>

                        <!-- Gestão de Usuários -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg shadow">
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Gestão de Usuários</h4>
                            <p>Administre os usuários que têm acesso ao sistema.</p>
                            <a href="{{ route('usuarios.index') }}" class="text-blue-500 hover:underline">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
