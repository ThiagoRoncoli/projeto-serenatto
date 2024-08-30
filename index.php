<?php

require "src/conexao-bd";
require "src/modelo/cls.Produto.php";
require "src/repositorio/cls.produto.repositorio.php";

$produtosRepositorio = new ProdutoRepositorio($pdo);
$dadosCafe = $produtosRepositorio->opcoesCafe();
$dadosAlmoco = $produtosRepositorio->opcoesAlmoco();

/* aqui vamos fazer com que ele puxe direto do banco os produtos e não fique estático como estava a baixo linha 21! 
após fazer o require aonde criamos a variavel pdo, podemos chamar ela aqui com o require e escrever ela
chamando o método query, onde ele espera receber uma instrução SQL para fazer uma conexão automatica*/
/*criamos a variavel sql1 para trazer todos as informações da tabela do tipo café do banco*/

/*$sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";*/

/*ORDER BY preco no retornará de forma crescente os preços dos produtos*/
/*Ou seja, o método query() recebe a variável $sql1, que armazena o comando responsável por selecionar, na tabela de produtos, os produtos do tipo "Café".

Se o método funcionar, deve nos retornar um objeto do tipo PDOStatement. Caso contrário, retornará "false". 
Sendo assim, faremos com que a variável $statement receba esse retorno:*/

/*$statement = $pdo->query($sql1); */

/*statement fetchALL é para retornar tudo que estiver na conexao, depoois nos temos que passar de que forma
esses vão vir, por isso colocamos PDO::FETCH_ASSOC que retorna um array associativo, deste modo, 
a chave de cada valor será correspondente à uma coluna do banco de dados. Ou seja, a coluna "tipo" 
será uma chave do array; a coluna "nome" será outra chave, e assim sucessivamente. E precisamos armazenar isso,
no nosso caso seria no produtosCafe.*/

/*$produtosCafe = $statement -> fetchAll(PDO::FETCH_ASSOC); */

/* Imagine que você tem uma caixa cheia de ingredientes para fazer um bolo, mas cada ingrediente está 
em um saquinho separado. Para fazer o bolo, você precisa juntar todos os ingredientes em uma tigela. 
A função array_map() é como um ajudante que pega cada saquinho da caixa, 
ele e coloca o ingrediente na tigela.
No nosso caso, a caixa é o $produtosCafe, que é um array com vários produtos. 
Cada produto é como um saquinho com informações como id, tipo, nome, descricao, imagem e preco. 
A função array_map() pega cada produto do $produtosCafe e usa a função function ($cafe) para criar um novo 
objeto Produto com as informações do produto.
A função function ($cafe) é como a receita do bolo. Ela pega cada ingrediente do saquinho ($cafe) e o 
coloca na tigela, que é o objeto Produto. No final, a array_map() retorna uma nova caixa com todos os 
produtos transformados em objetos Produto.
Essa nova caixa é como a tigela com todos os ingredientes prontos para fazer o bolo. 
Agora você pode usar os objetos Produto para acessar as informações de cada produto de forma 
organizada e fácil.*/


/*$dadosCafe = array_map(function ($cafe){
    return new Produto( 
        $cafe['id'], 
        $cafe['tipo'], 
        $cafe['nome'], 
        $cafe['descricao'], 
        $cafe['imagem'], 
        $cafe['preco']
        );
    }, $produtosCafe);

$sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
$statement = $pdo->query($sql2);
$produtosAlmoco = $statement -> fetchAll(PDO::FETCH_ASSOC);

$dadosAlmoco = array_map(function ($almoco){
    return new Produto(
        $almoco['id'],
        $almoco['tipo'],
        $almoco['nome'],
        $almoco['descricao'],
        $almoco['imagem'],
        $almoco['preco']
    );
}, $produtosAlmoco);
*/

/*$produtosCafe = [

        [
            'nome' => "Café cremoso",
            'descricao' => "Café cremosso irresístivelmente suave que envolve seu paladar",
            'preco' => "5.00",
            'imagem' => "img/cafe-cremoso-jpg"
        ],

        [
            'nome' => "Café com Leite",
            'descricao' => "A harmonia do café com o leite, uma experiência reconfortante",
            'preco' => "2.00",
            'imagem' => "img/cafe-com-leite-jpg"

        ],

        [
            'nome' => "Cappuccino",
            'descricao' => "Café suave, leite cremoso e uma pitada de sabor adocicado",
            'preco' => "7.00",
            'imagem' => "img/cappuccino.jpg"
        ],

        [
            'nome' => "Café Gelado",
            'descricao' => "Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo.",
            'preco' => "3.00",
            'imagem' => "img/cafe-gelado.jpg"
        ]
];


$produtosAlmoco = [

    [
        'nome' => "Bife",
        'descricao' => "Bife, arroz com feijão e uma deliciosa batata frita",
        'preco' => "27.90",
        'imagem' => "img/bife.jpg"
    ],

    [
        'nome' => "Filé de peixe",
        'descricao' => "Filé de peixe salmão assado, arroz, feijão verde e tomate.",
        'preco' => "24.99",
        'imagem' => "img/prato-peixe.jpg"
    ],

    [
        'nome' => "Frango",
        'descricao' => "Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante",
        'preco' => "23.00",
        'imagem' => "img/prato-frango.jpg"
    ],

    [
        'nome' => "Fettuccine",
        'descricao' => "Prato italiano autêntico da massa do fettuccine com peito de frango grelhado",
        'preco' => "22.50",
        'imagem' => "img/fettuccine.jpg"
    ],

];
*/


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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>
<body>
    <main>
        <section class="container-banner">
            <div class="container-texto-banner">
                <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
            </div>
        </section>
        <h2>Cardápio Digital</h2>
        <section class="container-cafe-manha">
            <div class="container-cafe-manha-titulo">
                <h3>Opções para o Café</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>

            <div class="container-cafe-manha-produtos">
<!-- aqui estou fazendo um array associativo, com um laço de repetição, introduzindo a variavel criada com o cafe -->
                <?php foreach($dadosCafe as $cafe): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src= <?= $cafe->getImagemDiretorio() ?> >
                    </div>
                    <p> <?= $cafe->getNome()?> </p>
                    <p> <?= $cafe->getDescricao()?> </p>
                    <p> <?= $cafe->getPrecoFormatado()?> </p>
                </div>
<!-- coloquei number_format pois estava aparecendo sem os centavos. Devido que na classe Produto, definimos o 
valor de $preco como float, mas quando vamos imprimir um valor do tipo ponto flutuante em PHP, 
ele tem o padrão de ignorar a parte flutuante que ele não considera interessante. 
No caso, o valor era "R$ 2.00", por isso ele ignorou.Por isso, ao chamarmos o $cafe->getPreco(), 
usaremos uma função chamada number_format(). Como primeiro parâmetro dessa função, 
precisamos passar o número de ponto flutuante, que é o $cafe->getPreco(), 
e como segundo parâmetro passamos a quantidade de casas decimais que queremos.-->

<!-- Ali abrimos a tag php com o sinal de igual é a mesma forma de abrir o php e colocar o echo, então essa é outra forma de
conseguir imprimir dentro das tags semanticas as variaveis 
que definimos no laço de repetição e chamamos as variaveis com os get que criamos na cls.Produto para 
conseguir mostrar na tele os elementos certos.
Na imagem coloquei img/ para ele trazer as imagem do arquivo "img" e concatenei. -->
<!-- aqui eu abro a tag php para finalizar o laço de repetição dessa div cafe manha -->
                <?php endforeach; ?>

            </div>
        </section>
        <section class="container-almoco">
            <div class="container-almoco-titulo">
                <h3>Opções para o Almoço</h3>
                <img class= "ornaments" src="img/ornaments-coffee.png" alt="ornaments">
            </div>
            <div class="container-almoco-produtos">
                <?php  foreach($dadosAlmoco as $almoco):?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src= <?= $almoco->getImagemDiretorio()?> >
                    </div>
                    <p><?= $almoco->getNome()?> </p>
                    <p><?= $almoco->getDescricao()?> </p>
                    <p><?= $almoco->getPrecoFormatado()?> </p>
                </div>
                <?php endforeach; ?>


                
            </div>

        </section>
    </main>
</body>
</html>