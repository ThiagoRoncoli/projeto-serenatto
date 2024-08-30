<?php
require "src/conexao-bd";
require "src/modelo/cls.Produto.php";
require "src/repositorio/cls.produto.repositorio.php";


$produtosRepositorio = new ProdutoRepositorio($pdo);
$produtos = $produtosRepositorio->bucarTodos();

?>


<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/admin.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Admin</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Admistração Serenatto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <h2>Lista de Produtos</h2>

  <section class="container-table">
    <table>
      <thead>
        <tr>
          <th>Produto</th>
          <th>Tipo</th>
          <th>Descricão</th>
          <th>Valor</th>
          <th colspan="2">Ação</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($produtos as $produto):  ?>
      <tr>
        <td><?= $produto->getNome()  ?></td>
        <td><?= $produto->getTipo()  ?></td>
        <td><?= $produto->getDescricao()  ?></td>
        <td><?= $produto->getPrecoFormatado()  ?></td>
<!--Imagine que você está construindo um site de venda de livros. Cada livro tem um código único, que seria o id do produto. Quando você clica no botão "Editar" para um livro específico, você precisa informar ao site qual livro você quer editar, certo?

Essa linha de código que você mencionou faz exatamente isso! Ela cria um link para a página editar-produto.php, mas adiciona um "recado" na URL, que é a query param id. Essa query param é como um bilhete que diz: "Olha, eu quero editar o livro com o código id igual a... ".

O $produto->getId() é a parte que pega o código único do livro que você está vendo na página. Então, quando você clica no botão "Editar", a URL vai ficar parecida com: editar-produto.php?id=12345, onde 12345 é o código do livro que você quer editar.

Assim, a página editar-produto.php sabe qual livro você quer editar e pode mostrar os dados dele para você! -->
                <!--Aqui estamos passando via URL o id do produto pelo getID -->

        <td><a class="botao-editar" href="editar-produto.php?id=<?= $produto->getId() ?>">Editar</a></td>
        <td>

      <!--Aqui no form vamos colocar uma action que será realizado quando apertamos o botão de excluir -->
        <!-- O hidden faz com que seja um campo oculto, e estamos colocando dentro do value a função
         que criamos para pegar o id do produto cadastrado, fazendo com que quando formos apertar o botão
         de excluir, excluiremos através do id de cada produto -->
        <!-- Vale lembrar que só conseguimos fazer isso de pegar pelo id pois estamos dentro do foreach -->
        <!--Colocamos o name="id" para que ele retorne como paramentro via URL o id. 
        ANTES:("localhost:8080/excluir-produto.php?") DEPOIS: ("localhost:8080/excluir-produto.php?") -->
        <!-- Agora não mais pois está em POST asntes estava sem method, e como padrão sem o method ele retorna
         como GET -->
          <form action="excluir-produto.php" method="post">
              <input type="hidden" name="id" value="<?= $produto->getId() ?>">
            <input type="submit" class="botao-excluir" value="Excluir">
          </form>
        </td>
        
      </tr>
      <?php endforeach;  ?>
 
      </tbody>
    </table>
  <a class="botao-cadastrar" href="cadastrar-produto.php">Cadastrar produto</a>
  <form action="gerador-pdf.php" method="post">
    <input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>
  </form>
  </section>
</main>
</body>
</html>