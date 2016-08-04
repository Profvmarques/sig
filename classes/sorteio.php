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

class Sorteio {

//Atributos da classe
    private $idsorteio;
    private $idprotocolo;
    private $sequencia;
    private $ordem_sorteio;
    private $data_sorteio;

    //Insert
    public function incluir($idprotocolo, $sequencia, $ordem_sorteio, $data_sorteio) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into sorteio(idprotocolo,sequencia,ordem_sorteio,data_sorteio) values( :idprotocolo, :sequencia, :ordem_sorteio, :data_sorteio);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idprotocolo', $idprotocolo);
            $stmt->bindParam(':sequencia', $sequencia);
            $stmt->bindParam(':ordem_sorteio', $ordem_sorteio);
            $stmt->bindParam(':data_sorteio', $data_sorteio);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'sorteio', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela sorteio = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idsorteio) {
        try {
            $sql = 'delete from sorteio where idsorteio= :idsorteio';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsorteio', $idsorteio);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'sorteio', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela sorteio = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idsorteio, $idprotocolo, $sequencia, $ordem_sorteio, $data_sorteio) {
        try {
            $sql = 'update sorteio set idsorteio=:idsorteio,idprotocolo=:idprotocolo,sequencia=:sequencia,ordem_sorteio=:ordem_sorteio,data_sorteio=:data_sorteio where idsorteio= :idsorteio';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsorteio', $idsorteio);
            $stmt->bindParam(':idprotocolo', $idprotocolo);
            $stmt->bindParam(':sequencia', $sequencia);
            $stmt->bindParam(':ordem_sorteio', $ordem_sorteio);
            $stmt->bindParam(':data_sorteio', $data_sorteio);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'sorteio', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela sorteio = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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