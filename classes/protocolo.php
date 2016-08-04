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

class Protocolo {

//Atributos da classe
    private $idprotocolo;
    private $idcandidatos;
    private $idturma;
    private $dtreg;

    //Insert
    public function incluir($idcandidatos, $idturma, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into protocolo(idcandidatos,idturma,dtreg) values( :idcandidatos, :idturma, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcandidatos', $idcandidatos);
            $stmt->bindParam(':idturma', $idturma);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'protocolo', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela protocolo = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idprotocolo) {
        try {
            $sql = 'delete from protocolo where idprotocolo= :idprotocolo';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idprotocolo', $idprotocolo);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'protocolo', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela protocolo = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idprotocolo, $idcandidatos, $idturma, $dtreg) {
        try {
            $sql = 'update protocolo set idprotocolo=:idprotocolo,idcandidatos=:idcandidatos,idturma=:idturma,dtreg=:dtreg where idprotocolo= :idprotocolo';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idprotocolo', $idprotocolo);
            $stmt->bindParam(':idcandidatos', $idcandidatos);
            $stmt->bindParam(':idturma', $idturma);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'protocolo', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela protocolo = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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