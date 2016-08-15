<?php

/* ----------------------------------------------
  Smart Web Developer - SWD 2.0
  Criado em 04/11/2011
  Autor:Vinícius Marques da Silva Ferreira
  Contato:profvmarques@gmail.com
  Projeto:sig  Criado em:11/08/2016
  ---------------------------------------------- */
require_once('acesso.php');
require_once('logs.php');

class Configuracao {

//Atributos da classe
    private $idmenu;
    private $idperfil;
    private $incluir;
    private $consultar;
    private $alterar;
    private $excluir;
    private $publico;

    //Insert
    public function incluir($incluir, $consultar, $alterar, $excluir, $publico) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into configuracao(incluir,consultar,alterar,excluir,publico) values( :incluir, :consultar, :alterar, :excluir, :publico);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':incluir', $incluir);
            $stmt->bindParam(':consultar', $consultar);
            $stmt->bindParam(':alterar', $alterar);
            $stmt->bindParam(':excluir', $excluir);
            $stmt->bindParam(':publico', $publico);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'configuracao', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela configuracao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idmenu) {
        try {
            $sql = 'delete from configuracao where idperfil= :idperfil';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'configuracao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela configuracao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idmenu, $idperfil, $incluir, $consultar, $alterar, $excluir, $publico) {
        try {
            $sql = 'update configuracao set idmenu=:idmenu,idperfil=:idperfil,incluir=:incluir,consultar=:consultar,alterar=:alterar,excluir=:excluir,publico=:publico where idperfil= :idperfil';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);
            $stmt->bindParam(':idperfil', $idperfil);
            $stmt->bindParam(':incluir', $incluir);
            $stmt->bindParam(':consultar', $consultar);
            $stmt->bindParam(':alterar', $alterar);
            $stmt->bindParam(':excluir', $excluir);
            $stmt->bindParam(':publico', $publico);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'configuracao', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela configuracao = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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