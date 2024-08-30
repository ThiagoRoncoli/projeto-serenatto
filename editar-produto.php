<?php
require "src/conexao-bd";
require "src/modelo/cls.Produto.php";
require "src/repositorio/cls.produto.repositorio.php";

/* aqui estamos pegando pela URL o id passado do produto feito nessa linha 
href="editar-produto.php?id=<?= $produto->getId() ?>"> 
*/

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produto = $produtoRepositorio->buscar($_GET['id']);

/*if (isset($_POST['editar']) verifica se o formulário de edição foi submetido, ou seja, 
o botão (ou qualquer elemento) com o nome editar foi enviado via método POST. 
Verifica se o usuario clicou no botão

$produto = new Produto($_POST['id'], $_POST['tipo'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);
Se o formulário de edição foi enviado, um novo objeto Produto é criado 
com base nos dados que vieram do formulário ($_POST).
O formulário deve ter campos como id, tipo, nome, descricao e preco, que estão sendo 
passados para o construtor da classe Produto.
Isso permite que um novo objeto Produto seja criado com os dados que foram editados pelo usuário.

$produtoRepositorio->atualizar($produto);
Aqui, o código está chamando o método atualizar() de um repositório 
($produtoRepositorio), que é responsável por atualizar os dados do produto no banco de dados.
O objeto $produto criado anteriormente é passado para o método atualizar(). 
Isso indica que o código está atualizando os dados do produto com as informações fornecidas no formulário.

else {
  $produto = $produtoRepositorio->buscar($_GET['id']);
}

Se o formulário de edição não foi enviado (ou seja, o botão editar não foi clicado), 
o código cai no bloco else.
Aqui, o código está buscando o produto no banco de dados com base no id que foi enviado via método GET 
(pela URL), usando o método buscar() do repositório ($produtoRepositorio).
Isso é geralmente usado para carregar os dados do produto para exibição em um formulário de edição.
*/

if (isset($_POST['editar'])) {
  $produto = new Produto($_POST['id'], $_POST['tipo'], $_POST['nome'], $_POST['descricao'], $_POST['preco']);

  if(isset($_FILES['imagem'])) {
    $produto->setImagem(uniqid(). $_FILES['imagem'] ['name']  == UPLOAD_ERR_OK );
    move_uploaded_file($_FILES['imagem'] ['tmp_name'], $produto->getImagemDiretorio() );
  }

  $produtoRepositorio->atualizar($produto);
  header("Location: admin.php");
} else {
  $produto = $produtoRepositorio->buscar($_GET['id']);
}


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
  <link rel="stylesheet" href="css/form.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
  <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
  <section class="container-admin-banner">
    <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
    <h1>Editar Produto</h1>
    <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
  </section>
  <section class="container-form">
    <form method="post" enctype="multipart/form-data">

      <label for="nome">Nome</label>
      <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" value="<?= $produto->getNome()?>" required>

      <div class="container-radio">
        <div>
            <label for="cafe">Café</label>
<!-- Abri o php dentro do input para verificar se o tipo do produto é "Café" e, se for, marca a opção "Café" no formulário se não marca nada -->
            <input type="radio" id="cafe" name="tipo" value="Café" <?= $produto->getTipo() == "Café"? "checked" : "" ?>>
        </div>
        <div>
            <label for="almoco">Almoço</label>
            <input type="radio" id="almoco" name="tipo" value="Almoço" <?= $produto->getTipo() == "Almoço"? "checked" : "" ?>>
        </div>
    </div>

      <label for="descricao">Descrição</label>
      <input type="text" id="descricao" name="descricao" placeholder="Digite uma descrição"  value="<?= $produto->getDescricao()?>" required>

      <label for="preco">Preço</label>
      <input type="text" id="preco" name="preco" placeholder="Digite o preço " value="<?= number_format($produto->getPreco(), 2)?>" required>

      <label for="imagem">Envie uma imagem do produto</label>
      <input type="hidden" name="id" value="<?= $produto->getId()?>" >
      <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

      <input type="submit" name="editar" class="botao-cadastrar"  value="Editar produto"/>
    </form>

  </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>