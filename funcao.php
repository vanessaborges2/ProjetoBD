<?php

    //Função para conexão com o banco de dados
    function conectarBanco(){
        //Instancio o meu objeto PDO que fornece as funções para manipulação dos dados
        $conexao = new PDO("mysql:host=localhost; dbname=bancophp", "root", "");
        return $conexao;
    }

    /*Existe uma relação da tabela categoria com a tabela produto. Portanto, preciso buscar todas as
    categorias do banco de dados para poder relacionar com os registros de produtos na minha aplicação
    A função abaixo faz essa busca e retorna todos os registros de categorias*/
    function retornarCategorias(){
        try {
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "SELECT * FROM categoria";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Executo a consulta, retornando o seu resultado
            return $conexao->query($sql);
        } catch (Exception $e) {
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }

    /*Para poder alterar ou excluir os produtos, preciso consultar todos os registros do banco de dados
    Utilizo o INNER JOIN para buscar no banco também os dados da categoria, para poder mostrar o nome da categoria 
    para o usuário, não apenas o seu código*/
    function retornarProdutos(){
        try {
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "SELECT p.*, c.descricao as categoria FROM produto p
                    INNER JOIN categoria c ON c.id = p.categoria_id";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Executo a consulta, retornando o seu resultado
            return $conexao->query($sql);
        } catch (Exception $e) {
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }

    //Função que realiza a inserção de um produto
    function inserirProduto($nome, $descricao, $valor, $categoria){
        try{ 
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "INSERT INTO produto (nome, descricao, valor, categoria_id)VALUES (:nome, :descricao, :valor, :categoria)";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Inicio a preparação do SQL para poder substituir os APELIDOS pelos valores passados por parâmetro
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":descricao", $descricao);
            $stmt->bindValue(":valor", $valor);
            $stmt->bindValue(":categoria", $categoria);
            //Executo a consulta, retornando o seu resultado
            return $stmt->execute();
        } catch (Exception $e){
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }

    //Para poder alterar ou excluir um registro, precisamos consultar o registro pela sua chave primária (id)
    function consultarProdutoId($id){
        try{ 
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "SELECT * FROM produto WHERE id = :id";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Inicio a preparação do SQL para poder substituir os APELIDOS pelos valores passados por parâmetro
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id", $id);
            //Executo a consulta
            $stmt->execute();
            //Retorno o registro já em formato de ARRAY
            return $stmt->fetch();
        } catch (Exception $e){
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }

    //Função que realiza a alteração de um produto
    function alterarProduto($nome, $descricao, $valor, $categoria, $id){
        try{ 
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "UPDATE produto SET nome = :nome, descricao = :descricao, valor = :valor, categoria_id = :categoria WHERE id = :id";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Inicio a preparação do SQL para poder substituir os APELIDOS pelos valores passados por parâmetro
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":nome", $nome);
            $stmt->bindValue(":descricao", $descricao);
            $stmt->bindValue(":valor", $valor);
            $stmt->bindValue(":categoria", $categoria);
            $stmt->bindValue(":id", $id);
            //Executo a consulta, retornando o seu resultado
            return $stmt->execute();
        } catch (Exception $e){
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }

    //Função que realiza a exclusão de um produto
    function excluirProduto($id){
        try{ 
            //Defino uma variável para declarar o SQL a ser executado
            $sql = "DELETE FROM produto WHERE id = :id";
            //Realizo a conexão com o banco de dados
            $conexao = conectarBanco();
            //Inicio a preparação do SQL para poder substituir os APELIDOS pelos valores passados por parâmetro
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id", $id);
            //Executo a consulta, retornando o seu resultado
            return $stmt->execute();
        } catch (Exception $e){
            //Caso aconteça algum erro, retorno o valor 0
            return 0;
        }
    }







