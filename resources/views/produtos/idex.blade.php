<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Laravel</title>
</head>
<body>
    <h1>Cadastro de Produtos</h1>

    <form action="/produtos" method="post">
    @csrf

    <label for="name">Nome</label>
    <input type="text" id="nome" name="nome" required><br><br>

     <label for="preco">Preço</label>
    <input type="text" step="0.01" id="nome" name="preco" required><br><br>

     <label for="estoque">Estoque</label>
    <input type="text" id="estoque" name="estoque" required><br><br>

    <button type="submite">Salvar<button>
</form>

<h2>Lista de produtos</h2>

@if($produtos ->isEmpity())

@else

@endif
    
</body>
</html>