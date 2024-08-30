<?php

/* na parte de cadastrar o produto não tem como colocar o id diretamente então podemos fazer
uma manipulação para cadastrarmos o produto, pois ele receberá o id assim 
que cadastrarmos. Por isso colocamos o ? antes do id, pois ele assim poderá recber esse parametro 
sendo nulo ou não */
class Produto{

    private ?int $id;

    private string $tipo;

    private string $nome;

    private string $descricao;

    private string $imagem;

    private float $preco;

/*Após a declaração dos atributos dessa classe, precisamos criar um construtor para que, 
quando inicializarmos um objeto, ele já tenha esses dados.*/

/* aqui a imagem etá recebendo isso: = "logo-serenatto.png" pois no pedido do cliente pede que se não tivermos
imagem do produto, tem que aparecer essa frase no lugar da imagem. Ficando assim uma "imagem" padrão. */
    public function __construct(?int $id, string $tipo, string $nome, string $descricao,
    float $preco, string $imagem = "logo-serenatto.png"){

        $this->id = $id;
        $this->tipo = $tipo;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
        $this->preco = $preco;
    }

/*Também criaremos os métodos getters para recuperar os dados fora dessa classe.*/
    public function getId(): int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }


    public function getImagemDiretorio(): string
    {
        return "img/" . $this->imagem;
    }



    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getPrecoFormatado():string{
        return 'R$' .number_format($this->preco, 2);
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }


    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }
}
