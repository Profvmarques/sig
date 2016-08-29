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

class AcessoUsuario {

//Atributos da classe
    private $idmenu;
    private $idusuarios;
    private $incluir;
    private $consultar;
    private $alterar;
    private $excluir;

    //Insert
    public function incluir($idmenu, $idusuarios, $incluir, $consultar, $alterar, $excluir) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into acessousuario(idmenu,idusuarios,incluir,consultar,alterar,excluir) values( :idmenu, :idusuarios, :incluir, :consultar, :alterar, :excluir);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':incluir', $incluir);
            $stmt->bindParam(':consultar', $consultar);
            $stmt->bindParam(':alterar', $alterar);
            $stmt->bindParam(':excluir', $excluir);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'acessousuario', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela acessousuario = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idmenu) {
        try {
            $sql = 'delete from acessousuario where idmenu= :idmenu';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'acessousuario', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela acessousuario = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idmenu, $idusuarios, $incluir, $consultar, $alterar, $excluir) {
        try {
            $sql = 'update acessousuario set idmenu=:idmenu,idusuarios=:idusuarios,incluir=:incluir,consultar=:consultar,alterar=:alterar,excluir=:excluir where idmenu= :idmenu';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':incluir', $incluir);
            $stmt->bindParam(':consultar', $consultar);
            $stmt->bindParam(':alterar', $alterar);
            $stmt->bindParam(':excluir', $excluir);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'acessousuario', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela acessousuario = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    public function consultar($sql) {
        $acesso = new Acesso();
        $acesso->conexao();
        $acesso->query($sql);
        $this->Linha = $acesso->linha;
        $this->Result = $acesso->result;
    }

    public function obterAcessoUsuario($idmenu, $idusuarios) {
        $acesso = new Acesso();
        $acesso->conexao();
        if ($idmenu > 0 && $idperfil > 0) {
            $sql = "select * from acessousuario where idmenu=" . $idmenu . " and idusuarios=" . $idusuarios;
            $acesso->query($sql);
            $linha = $acesso->linha;
            $rs = $acesso->result;
        }
        if ($linha > 0) {
            $this->achou = 'SIM';
        } else {
            $this->achou = "NAO";
        }
    }

}

?>