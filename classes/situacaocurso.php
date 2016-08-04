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

class Situacaocurso {

//Atributos da classe
    private $idsituacao_curso;
    private $descricao;

    //Insert
    public function incluir($descricao) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into situacaocurso(descricao) values( :descricao);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaocurso', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idsituacao_curso) {
        try {
            $sql = 'delete from situacaocurso where idsituacao_curso= :idsituacao_curso';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsituacao_curso', $idsituacao_curso);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaocurso', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idsituacao_curso, $descricao) {
        try {
            $sql = 'update situacaocurso set idsituacao_curso=:idsituacao_curso,descricao=:descricao where idsituacao_curso= :idsituacao_curso';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsituacao_curso', $idsituacao_curso);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'situacaocurso', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela situacaocurso = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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