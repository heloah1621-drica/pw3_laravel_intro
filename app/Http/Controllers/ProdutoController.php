<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //
    public function index()
    {
        $produtos = Produtos:: orderBy('nome')->get();
        return view('produtos.index', compact('produtos'));
    }

    public function store(Request $request)
    {
        $dados = $requirest->validate([
            'nome' => 'required|min:3',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|interger|min:0'
        ]);

        Produto::create($dados);

        return redirect('/produtos');
    }
}
