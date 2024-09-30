<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Certifique-se de que o modelo User existe

class UsuarioController extends Controller
{
    // Função para listar todos os usuários
    public function index()
    {
        // Busca todos os usuários no banco de dados
        $usuarios = User::all();

        // Retorna a view de listagem de usuários passando a lista de usuários
        return view('usuarios.index', compact('usuarios'));
    }

    // Função para exibir um usuário específico
    public function show($id)
    {
        // Busca o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Retorna a view de exibição do usuário, passando os dados do usuário encontrado
        return view('usuarios.show', compact('usuario'));
    }

    // Função para exibir o formulário de criação de um novo usuário
    public function create()
    {
        // Retorna a view de criação de usuário
        return view('usuarios.create');
    }

    // Função para salvar um novo usuário
    public function store(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Criação de um novo usuário no banco de dados
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')), // Encriptação da senha
        ]);

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    // Função para exibir o formulário de edição de um usuário específico
    public function edit($id)
    {
        // Busca o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Retorna a view de edição, passando os dados do usuário
        return view('usuarios.edit', compact('usuario'));
    }

    // Função para atualizar os dados de um usuário
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        // Busca o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Atualiza os dados do usuário
        $usuario->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $usuario->password,
        ]);

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Função para excluir um usuário
    public function destroy($id)
    {
        // Busca o usuário pelo ID
        $usuario = User::findOrFail($id);

        // Exclui o usuário
        $usuario->delete();

        // Redireciona para a lista de usuários com uma mensagem de sucesso
        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
