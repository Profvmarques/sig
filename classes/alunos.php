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

class Alunos {

//Atributos da classe
    private $idalunos;
    private $idpessoas;
    private $dtreg;

    //Insert
    public function incluir($idpessoas, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into alunos(idpessoas,dtreg) values( :idpessoas, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'alunos', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela alunos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idalunos) {
        try {
            $sql = 'delete from alunos where idalunos= :idalunos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idalunos', $idalunos);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'alunos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela alunos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idalunos, $idpessoas, $dtreg) {
        try {
            $sql = 'update alunos set idalunos=:idalunos,idpessoas=:idpessoas,dtreg=:dtreg where idalunos= :idalunos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idalunos', $idalunos);
            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'alunos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela alunos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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