<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\ProdutoCategoria;
use Illuminate\Http\Request;


class ProdutoCategoriaController extends Controller
{
    /**
     * Lista todos os produtos carregando a categoria relacionada (Eager Loading).
     */
    public function index()
    {
        $produtos = ProdutoCategoria::with('categoria')->orderBy('id', 'desc')->paginate(10);
        return view('produto_categoria.index', compact('produtos'));
    }

    /**
     * Exibe o formulário de cadastro enviando a lista de categorias.
     */
    public function create()
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('produto_categoria.create', compact('categoria'));
    }

    /**
     * Valida os dados e salva o novo produto no banco.
     */
    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|min:3|max:255',
            'preco' => 'required|numeric|min:0.01',
            'quantidade_estoque' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        ProdutoCategoria::create($dadosValidados);

        return redirect()->route('produto_categoria.index')->with('sucesso', 'Produto cadastrado com sucesso');
    }

    /**
     * Exibe os detalhes de um produto específico.
     */
    public function show(ProdutoCategoria $produto)
    {
        return view('produto_categoria.show', compact('produto'));
    }

    /**
     * Exibe o formulário de edição com os dados atuais e as categorias disponíveis.
     */
    public function edit(ProdutoCategoria $produto)
    {
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('produto_categoria.edit', compact('produto', 'categoria'));
    }

    /**
     * Valida e atualiza as informações do produto.
     */
    public function update(Request $request, ProdutoCategoria $produto)
    {
        $dadosValidados = $request->validate([
            'nome' => 'required|min:3|max:255',
            'preco' => 'required|numeric|min:0.01',
            'quantidade_estoque' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $produto->update($dadosValidados);

        return redirect()->route('produto_categoria.index')->with('sucesso', 'Produto atualizado com sucesso');
    }

    /**
     * Exclui o produto do banco de dados.
     */
    public function destroy(ProdutoCategoria $produto)
    {
        $produto->delete();

        return redirect()->route('produto_categoria.index')->with('sucesso', 'Produto removido com sucesso');
    }
}