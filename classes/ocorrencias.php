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

class Ocorrencias {

//Atributos da classe
    private $idocorrencias;
    private $idusuarios;
    private $query_executada;
    private $tabela;
    private $acao;
    private $dtreg;

    //Insert
    public function incluir($idusuarios, $query_executada, $tabela, $acao, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into ocorrencias(idusuarios,query_executada,tabela,acao,dtreg) values( :idusuarios, :query_executada, :tabela, :acao, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':query_executada', $query_executada);
            $stmt->bindParam(':tabela', $tabela);
            $stmt->bindParam(':acao', $acao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'ocorrencias', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela ocorrencias = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idocorrencias) {
        try {
            $sql = 'delete from ocorrencias where idocorrencias= :idocorrencias';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idocorrencias', $idocorrencias);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'ocorrencias', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela ocorrencias = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idocorrencias, $idusuarios, $query_executada, $tabela, $acao, $dtreg) {
        try {
            $sql = 'update ocorrencias set idocorrencias=:idocorrencias,idusuarios=:idusuarios,query_executada=:query_executada,tabela=:tabela,acao=:acao,dtreg=:dtreg where idocorrencias= :idocorrencias';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idocorrencias', $idocorrencias);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':query_executada', $query_executada);
            $stmt->bindParam(':tabela', $tabela);
            $stmt->bindParam(':acao', $acao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'ocorrencias', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela ocorrencias = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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