<?php

/* ----------------------------------------------
  Smart Web Developer - SWD 2.0
  Criado em 04/11/2011
  Autor:Vinícius Marques da Silva Ferreira
  Contato:profvmarques@gmail.com
  Projeto:SIG  Criado em:14/07/2016
  ---------------------------------------------- */
require_once('acesso.php');
require_once('logs.php');

class Unidadegestao {

//Atributos da classe
    private $idunidade_gestao;
    private $descricao;
    private $responsavel;
    private $endereco;
    private $bairro;
    private $telefone;
    private $celular;
    private $email;
    private $iddistrito;

    //Insert
    public function incluir($descricao, $responsavel, $endereco, $bairro, $telefone, $celular, $email, $iddistrito) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into unidadegestao(descricao,responsavel,endereco,bairro,telefone,celular,email,iddistrito) values( :descricao, :responsavel, :endereco, :bairro, :telefone, :celular, :email, :iddistrito);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':responsavel', $responsavel);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':iddistrito', $iddistrito);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'unidadegestao', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela unidadegestao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idunidade_gestao) {
        try {
            $sql = 'delete from unidadegestao where idunidade_gestao= :idunidade_gestao';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idunidade_gestao', $idunidade_gestao);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'unidadegestao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela unidadegestao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idunidade_gestao, $descricao, $responsavel, $endereco, $bairro, $telefone, $celular, $email, $iddistrito) {
        try {
            $sql = 'update unidadegestao set idunidade_gestao=:idunidade_gestao,descricao=:descricao,responsavel=:responsavel,endereco=:endereco,bairro=:bairro,telefone=:telefone,celular=:celular,email=:email,iddistrito=:iddistrito where idunidade_gestao= :idunidade_gestao';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idunidade_gestao', $idunidade_gestao);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':responsavel', $responsavel);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':iddistrito', $iddistrito);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'unidadegestao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela unidadegestao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function consultar($sql) {
        $acesso = new Acesso();
        $acesso->conexao();
        $acesso->query($sql);
        $this->Linha = $acesso->linha;
        $this->Result = $acesso->result;
    }

}

?>