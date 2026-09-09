<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UseController extends Controller
{
    /**
     * Exiba a listagem de usuários com suporte a filtro de busca
     */
    public function index(Request $request)
    {
        $busca = $request ->input('busca');

        if ($busca){
            // select * from users where name = 'ana'
            // select * from users where name = '%ana%'
            $usuarios = User::where('name','like',"%{$busca}%",'and')->orderBy('name','ASC')->get();

        } else {
            $usuarios = User::orderBy('name','ASC')->get();
        }

        
        return view('admin.dashboard', compact('usuarios','busca'));

    }

    # Exiba o formulário de cadastro do usuário

    public function create()
    {
        return view('users.create');
    }

    # Salvar o novo usuário no banco de dadoscom validação
    
    public function store(Request $request)
    {
        // Validação dos campos do formulário
        $dadosValidados = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Persistência no banco usando o ORM Eloquent
        User::create($dadosValidados);

        // Redirecionar para o painel administrativo com mensagens de sucesso
        return redirect('/admin')->with('sucesso','Usuário cadastrado com sucesso.');
    }


}
