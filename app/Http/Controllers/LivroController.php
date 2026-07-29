<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;

class LivroController extends Controller
{
     public function index()
    {
        $livros = Livro:: orderBy('titulo')->get();
        return view('livros.index', compact('livros'));
    }

     public function store(Request $request)
    {
        $dados = $request->validate([
            'titulo' => 'required|min:2',
            'autor' => 'required|min:3',
            'ano_publicacao' => 'required|date|min:8',
        ]);

  
        Livro::create($dados);

        return redirect('/livros');
    }
}
