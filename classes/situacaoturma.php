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

class Situacaoturma {

//Atributos da classe
    private $idsituacao_turma;
    private $descricao;

    //Insert
    public function incluir($descricao) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into situacaoturma(descricao) values( :descricao);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaoturma', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaoturma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idsituacao_turma) {
        try {
            $sql = 'delete from situacaoturma where idsituacao_turma= :idsituacao_turma';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsituacao_turma', $idsituacao_turma);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaoturma', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaoturma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idsituacao_turma, $descricao) {
        try {
            $sql = 'update situacaoturma set idsituacao_turma=:idsituacao_turma,descricao=:descricao where idsituacao_turma= :idsituacao_turma';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsituacao_turma', $idsituacao_turma);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaoturma', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaoturma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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