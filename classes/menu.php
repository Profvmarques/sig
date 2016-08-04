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

class Menu {

//Atributos da classe
    private $idmenu;
    private $idmodulos;
    private $class;
    private $url;
    private $dtreg;

    //Insert
    public function incluir($idmodulos, $class, $url, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into menu(idmodulos,class,url,dtreg) values( :idmodulos, :class, :url, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmodulos', $idmodulos);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'menu', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela menu = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idmenu) {
        try {
            $sql = 'delete from menu where idmenu= :idmenu';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'menu', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela menu = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idmenu, $idmodulos, $class, $url, $dtreg) {
        try {
            $sql = 'update menu set idmenu=:idmenu,idmodulos=:idmodulos,class=:class,url=:url,dtreg=:dtreg where idmenu= :idmenu';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);
            $stmt->bindParam(':idmodulos', $idmodulos);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'menu', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela menu = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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