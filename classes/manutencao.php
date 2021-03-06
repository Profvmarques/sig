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

class Manutencao {

//Atributos da classe
    private $idusuarios;
    private $idcorrecoes;
    private $descricao;
    private $dtreg;

    //Insert
    public function incluir($idcorrecoes, $descricao, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into manutencao(idcorrecoes,descricao,dtreg) values( :idcorrecoes, :descricao, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcorrecoes', $idcorrecoes);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'manutencao', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela manutencao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idusuarios) {
        try {
            $sql = 'delete from manutencao where idusuarios= :idusuarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idusuarios', $idusuarios);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'manutencao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela manutencao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idusuarios, $idcorrecoes, $descricao, $dtreg) {
        try {
            $sql = 'update manutencao set idusuarios=:idusuarios,idcorrecoes=:idcorrecoes,descricao=:descricao,dtreg=:dtreg where idusuarios= :idusuarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':idcorrecoes', $idcorrecoes);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'manutencao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela manutencao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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