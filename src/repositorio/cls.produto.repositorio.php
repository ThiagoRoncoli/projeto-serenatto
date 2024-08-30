<?php

/*No arquivo index.php tinhamos muitos códigos de conexão com o banco de dados, buscando esses dados. 
E isso não está legal. Iria ser muito trabalhoso fazer a manutenção disso. 
O ideal é extrair isso para uma classe.    */

/* Ai fizemos uma function com os códigos que estvam no index com as conexoes para ser mais organizado*/


/*class ProdutoRepositorio
{
    private PDO $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function opcoesCafe()
{
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe){
            return new Produto($cafe['id'],
          $cafe['tipo'],
          $cafe['nome'],
          $cafe['descricao'],
          $cafe['imagem'],
          $cafe['preco'],
          );
  },$produtosCafe);
}



public function opcoesCafe(): array
{
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe){
            return new Produto($cafe['id'],
          $cafe['tipo'],
          $cafe['nome'],
          $cafe['descricao'],
          $cafe['imagem'],
          $cafe['preco'],
          );
  },$produtosCafe);
    
  return $dadosCafe;
}

} */




/*Podemos melhorar o código acima extraindo a instância de um objeto produto para um 
método privado formarObjeto. Da seguinte maneira: , assim evitando duplicidade de código*/


class ProdutoRepositorio
{
    private PDO $pdo;

    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Produto($dados['id'],
            $dados['tipo'],
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['imagem']);

    }

    public function opcoesCafe(): array
    {
        $sql1 = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
        $statement = $this->pdo->query($sql1);
        $produtosCafe = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosCafe = array_map(function ($cafe){
            return $this->formarObjeto($cafe);
        },$produtosCafe);

        return $dadosCafe;
    }
    public function opcoesAlmoco(): array
    {
        $sql2 = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
        $statement = $this->pdo->query($sql2);
        $produtosAlmoco = $statement->fetchAll(PDO::FETCH_ASSOC);

        $dadosAlmoco = array_map(function ($almoco){
            return $this->formarObjeto($almoco);
        },$produtosAlmoco);

        return  $dadosAlmoco;
    }




/* aqui estou fazendo um função para buscar todos os produtos do banco */
/* fetchAll busca todos os dados do banco, da forma com PDO::FETCH_ASSOC  que é ele associando todas as colunas
com os nomes das chaves aqui do array do php */
/*estou guardando numa variavel (dados) a busca que ele irá retornar esses dados na variavel (dados)*/ 
    public function bucarTodos(){

        $sql = "SELECT * FROM produtos ORDER BY preco";
        $statement = $this->pdo->query($sql);
        $dados = $statement-> fetchAll(PDO::FETCH_ASSOC);

        $todosOsDados = array_map(function ($produto){
            return $this->formarObjeto($produto);
        },$dados);

        return $todosOsDados;

    }


/* "DELETE FROM produto WHERE id = ?"; Essa linha diz ao banco de dados: "Exclua da tabela 'produtos' todas as
linhas onde o 'id' seja igual ao valor que eu te passar depois". A interrogação ? 
é como um espaço reservado para o valor do "id"que você quer excluir. 
É como se você dissesse: "Tira da lista de produtos o item que tem o número
[espaço para o número]". Depois, você preenche esse espaço com o número do produto que quer remover.
Essa forma de escrever a instrução SQL é chamada de "instrução preparada", que é mais segura e eficiente
do que colocar o valor do "id" diretamente na instrução.*/


/*Imagine que você está construindo um robô que precisa saber como remover um objeto específico de uma caixa.
A linha $statement = $this->pdo->prepare($sql); é como você ensinando o robô a fazer isso.
$sql é como um manual de instruções que diz: "Para remover um objeto da caixa, siga estes passos: 
1. Encontre o objeto com o número [número do objeto]. 
2. Retire o objeto da caixa."
$this->pdo é como o cérebro do robô, que sabe como interpretar as instruções.
prepare() é como o robô lendo o manual de instruções e entendendo os passos para remover o objeto.
$statement é como o robô pronto para remover o objeto, esperando apenas que você diga qual objeto ele 
deve remover.
Então, essa linha faz o seguinte:

O robô recebe o manual de instruções ($sql).
O cérebro do robô ($this->pdo) lê o manual de instruções.
O robô entende os passos para remover o objeto (prepare()).
O robô está pronto para remover o objeto ($statement).
Depois de preparar o robô, você pode dizer qual objeto ele deve remover, 
e ele irá seguir os passos que aprendeu no manual de instruções.
*/



/*A linha $statement->bindValue(1, $id); é usada para inserir um valor específico em uma instrução SQL 
preparada.

Vamos analisar cada parte:

$statement: É uma variável que representa a instrução SQL preparada. Ela já contém a estrutura da instrução, 
mas ainda não tem os valores específicos. bindValue: É um método que permite inserir um valor específico na 
instrução SQL preparada.
1: É um número que indica a posição do valor na instrução SQL preparada.
$id: É uma variável que contém o valor que você quer inserir na instrução SQL preparada.
Então, essa linha faz o seguinte:

Pega a instrução SQL preparada armazenada na variável $statement.
Insere o valor armazenado na variável $id na posição 1 da instrução SQL preparada.
Essa linha é importante porque protege o código contra ataques de injeção de SQL. 
Ao usar bindValue, você garante que o valor inserido na instrução SQL seja tratado como um valor literal, 
e não como código SQL.*/


/*O número 1 na linha $statement->bindValue(1, $id); representa a posição do parâmetro na 
instrução SQL preparada.
Lembre-se que a instrução SQL preparada pode ter vários parâmetros, representados por ?.
Por exemplo, a instrução SQL DELETE FROM produtos WHERE id = ? tem um único parâmetro, 
que é o id do produto que você quer excluir.
O número 1 indica que o valor da variável $id deve ser inserido na primeira posição do parâmetro 
na instrução SQL preparada.

Se a instrução SQL preparada tivesse mais parâmetros, você usaria números diferentes para indicar a 
posição de cada parâmetro.
Por exemplo, se a instrução SQL preparada fosse UPDATE produtos SET nome = ?, 
preco = ? WHERE id = ?, 
você usaria $statement->bindValue(1, $nome);, $statement->bindValue(2, $preco); 
e $statement->bindValue(3, $id); para inserir os valores corretos em cada posição.*/

    public function deletar(int $id){

    $sql = "DELETE FROM produtos WHERE id = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1,$id);
    $statement->execute();
    }





/*Entre as chaves do método, escreveremos um $sql que será responsável por fazer o cadastro no banco de dados.
Para isso, colocaremos entre aspas duplas a instrução 
INSERT INTO produtos (tipo, nome, descricao, preco, imagem).
Com isso, indicamos que devem ser inseridos 
na tabela produtos os campos tipo, nome, descricao, preco e imagem. Colocamos os VALUES com
? para que recebamos os valores ao cadastrar, ali só estamos definindo a quantidade dos campos.*/


/*Usamos o statement para realizar uma referência a uma instrução SQL preparada, aí chamamos o objeto
pdo que declaramos na classe sendo a nossa conexão com o banco criada anteriormente, passando o prepare
para preparar a consulta sql assim que for necessária a execução, passando o $sql criado em cima
com o comando que ele irá realizar posteriormente, por isso passamos no final como ($sql); */


/*placeholder é as interrogações! */

/*Usamos o método bindValue() para associar os valores dos atributos do objeto Produto aos placeholders 
da consulta SQL: , bindValue(1, $produto->getTipo()): Substitui o primeiro ? da consulta pelo valor 
retornado pelo método getTipo() do objeto Produto. Assim por diante.*/

    public function salvar(Produto $produto){
        $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $produto->getTipo());
        $statement->bindValue(2, $produto->getNome());
        $statement->bindValue(3, $produto->getDescricao());
        $statement->bindValue(4, $produto->getPreco());
        $statement->bindValue(5, $produto->getImagem());
        $statement->execute();

    }

/* usamos o fetch poi queremos buscar só um elemento e não todos como fetchall */
/*A variável $dados guarda as informações do produto que você buscou no banco de dados, mas ainda estão no 
formato do banco. A função formarObjeto() pega esses dados e transforma em um objeto do tipo Produto, 
que é como um "pacote" organizado com as informações do produto, como nome, preço, descrição, etc.
Então, a linha return $this->formarObjeto($dados); pega os dados do banco, traduz para
o formato que criamos anteriosmente no formarObjeto.  */

    public function buscar(int $id){
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $id);
        $statement->execute();

        $dados = $statement->fetch(PDO::FETCH_ASSOC);

        return $this->formarObjeto($dados);
    }




/*Estamos colocando tipo = ? e assim por diante pois estamos esperando receber valores indefinidos(valores
que receberemos ainda) 
nesses parametreos, onde sejam novos para ser atualizados no banco quando formos editar 
um produto e quisermos salvar a edição no banco de dados!  */

public function atualizar(Produto $produto){

    $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ? WHERE id = ?";

    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $produto->getTipo());
    $statement->bindValue(2, $produto->getNome());
    $statement->bindValue(3, $produto->getDescricao());
    $statement->bindValue(4, $produto->getPreco());
    $statement->bindValue(5, $produto->getId());
    $statement->execute();


/*Observação: Um outro detalhe que não foi discutido no vídeo é que, ao editar um produto, 
será atualizado o valor da imagem no banco de dados, enviando uma imagem ou não. Isso ocorre
porque, ao receber os dados do formulário, estamos sempre criando uma instância da classe Produto
e, nessa classe, definimos a imagem padrão como logo-serenatto.png.  
Para solucionar esse problema, podemos alterar o método atualizar() da classe 
ProdutoRepositorio para não atualizar a imagem, tirando isso: 
$statement->bindValue(5, $produto->getImagem());
Em seguida, neste mesmo método, podemos atualizar a imagem somente quando o 
valor de $produto->getImagem() for diferente da imagem padrão, ou seja, diferente de logo-serenatto.png.
A implementação ficará assim:
*/

    if($produto->getImagem() !== 'logo-serenatto.png'){
            
        $this->atualizarFoto($produto);
    }
}

private function atualizarFoto(Produto $produto){

$sql = "UPDATE produtos SET imagem = ? WHERE id = ?";

$statement = $this->pdo->prepare($sql);
$statement->bindValue(1, $produto->getImagem());
$statement->bindValue(2, $produto->getId());
$statement->execute();
}
/*Dessa forma, garantimos que a imagem só será atualizada se uma nova imagem for enviada pelo usuário.*/

}

?>