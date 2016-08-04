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

class Tipocurso {

//Atributos da classe
    private $idtipocurso;
    private $descricao;

    //Insert
    public function incluir($descricao) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into tipocurso(descricao) values( :descricao);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'tipocurso', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela tipocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idtipocurso) {
        try {
            $sql = 'delete from tipocurso where idtipocurso= :idtipocurso';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idtipocurso', $idtipocurso);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'tipocurso', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela tipocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idtipocurso, $descricao) {
        try {
            $sql = 'update tipocurso set idtipocurso=:idtipocurso,descricao=:descricao where idtipocurso= :idtipocurso';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idtipocurso', $idtipocurso);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'tipocurso', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela tipocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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