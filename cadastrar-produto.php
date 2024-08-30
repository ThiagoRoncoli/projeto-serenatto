<?php

require "src/conexao-bd";
require "src/modelo/cls.Produto.php";
require "src/repositorio/cls.produto.repositorio.php";


/* O if é para veririficar se o usuario está clicando no botão cadastrar que foi definido no name aqui
no HTML como cadastro */

/* Aqui ele recebrá como parametro o id como null pois não temos como colocar manualmente o id no produto, 
ele receberá assim que cadastrado */


if(isset($_POST['cadastro'])){

    $produto = new Produto(null,
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco']

    );

/* Vamos usar a super globl FILES pois ela trabalha com arquivos e iremos usar ela para trabalhar com imagens */
/* Tmp_name é o diretório que o proprio código "salva" automáticamente a imagem, por isso estamos pegando 
ela nessa super global */
/*Imagine que você está organizando um álbum de fotos e precisa dar um nome para cada imagem.
A linha $produto -> setImagem($_FILES['imagem']['name']); é como você está pegando o nome original 
da imagem que o usuário escolheu e colocando esse nome no álbum.

O $_FILES['imagem']['name'] é como se você estivesse pegando o nome da imagem diretamente do computador 
do usuário. E o $produto -> setImagem() é como você está colocando esse nome dentro do objeto $produto,
que representa o produto que está sendo cadastrado.

Dessa forma, você garante que o nome da imagem seja salvo junto com as informações do produto,
para que você possa encontrá-la mais tarde.*/
/* uniqid cria uma id única para a  imagem */
/*Além disso, precisamos fazer uma verificação com if, pois não é sempre que esse arquivo de 
imagem vai vir, if (isset($_FILES['imagem'])). */

/*podemos usar essa informação para verificar se alguma imagem foi enviada. Nesse caso, 
podemos utilizar a constante UPLOAD_ERR_OK, que se refere ao valor 0, indicando 
que o upload foi bem-sucedido.
Valor 0: não houve erro, o upload foi bem sucedido.
Valor 4: Nenhum arquivo foi enviado. */

if(isset($_FILES['imagem'])) {
    $produto->setImagem(uniqid(). $_FILES['imagem'] ['name'] == UPLOAD_ERR_OK );

/*move_uploaded_file usamos para mover a imagem de um lugar para outro, temos que passar como primeiro parametro
onde ele está localizado e no segundo onde queremos move-lo para guarda-lo  */
    move_uploaded_file($_FILES['imagem'] ['tmp_name'], $produto->getImagemDiretorio() );
}

    $produtoRepositorio = new ProdutoRepositorio($pdo);
    $produtoRepositorio->salvar($produto);
    header("Location: admin.php");
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
    <title>Serenatto - Cadastrar Produto</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Produtos</h1>
        <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
<!--O enctype="multipart/form-data" é como se você estivesse dizendo para o seu formulário: 
"Ei, prepare-se para receber arquivos, além de textos!" -->
        <form method="post" enctype="multipart/form-data">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input type="radio" id="cafe" name="tipo" value="Café" checked>
                </div>
                <div>
                    <label for="almoco">Almoço</label>
                    <input type="radio" id="almoco" name="tipo" value="Almoço">
                </div>
            </div>
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Digite uma descrição" required>

            <label for="preco">Preço</label>
            <input type="text" id="preco" name="preco" placeholder="Digite uma descrição" required>

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar produto"/>
        </form>
    
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>