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

class Modulos {

//Atributos da classe
    private $idmodulos;
    private $idsistemas;
    private $descricao;
    private $dtreg;

    //Insert
    public function incluir($idsistemas, $descricao, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into modulos(idsistemas,descricao,dtreg) values( :idsistemas, :descricao, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsistemas', $idsistemas);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'modulos', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela modulos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idmodulos) {
        try {
            $sql = 'delete from modulos where idmodulos= :idmodulos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmodulos', $idmodulos);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'modulos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela modulos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idmodulos, $idsistemas, $descricao, $dtreg) {
        try {
            $sql = 'update modulos set idmodulos=:idmodulos,idsistemas=:idsistemas,descricao=:descricao,dtreg=:dtreg where idmodulos= :idmodulos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmodulos', $idmodulos);
            $stmt->bindParam(':idsistemas', $idsistemas);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'modulos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela modulos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function consultar($sql) {
        $acesso = new Acesso();
        $acesso->conexao();
        $acesso->query($sql);
        $this->Linha = $acesso->linha;
        $this->Result = $acesso->result;
    }

    public function obterDescricaoModulo($idmodulos) {
        $acesso = new Acesso();
        $acesso->conexao();
        if ($idmodulos > 0) {
            $sql = "select * from modulos where idmodulos=".$idmodulos;
            $acesso->query($sql);
            $this->Linha = $acesso->linha;
            $rs = $acesso->result;

            $modulo = $rs[0]['sigla_modulo']." - ".$rs[0]['descricao'];
        } else {
            $modulo="------";
        }
        return $modulo;
    }

}

?>