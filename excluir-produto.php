<?php
require "src/conexao-bd";
require "src/modelo/cls.Produto.php";
require "src/repositorio/cls.produto.repositorio.php";


$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtoRepositorio->deletar($_POST['id']);

    
    header("Location: admin.php");





?>