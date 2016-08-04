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

class Matricula {

//Atributos da classe
    private $idmatricula;
    private $idsorteio;
    private $idalunos;
    private $dtreg;

    //Insert
    public function incluir($idsorteio, $idalunos, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into matricula(idsorteio,idalunos,dtreg) values( :idsorteio, :idalunos, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsorteio', $idsorteio);
            $stmt->bindParam(':idalunos', $idalunos);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'matricula', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela matricula = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idmatricula) {
        try {
            $sql = 'delete from matricula where idmatricula= :idmatricula';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmatricula', $idmatricula);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'matricula', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela matricula = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idmatricula, $idsorteio, $idalunos, $dtreg) {
        try {
            $sql = 'update matricula set idmatricula=:idmatricula,idsorteio=:idsorteio,idalunos=:idalunos,dtreg=:dtreg where idmatricula= :idmatricula';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmatricula', $idmatricula);
            $stmt->bindParam(':idsorteio', $idsorteio);
            $stmt->bindParam(':idalunos', $idalunos);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'matricula', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela matricula = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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