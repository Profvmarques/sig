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
    private $id_pai;
    private $ordem;
    private $menu;
    private $class;
    private $url;
    private $dtreg;

    //Insert
    public function incluir($idmodulos, $id_pai, $ordem, $menu, $class, $url) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into menu(idmodulos,id_pai,ordem,menu,class,url) values( :idmodulos, :id_pai, :ordem, :menu, :class, :url);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmodulos', $idmodulos);
            $stmt->bindParam(':id_pai', $id_pai);
            $stmt->bindParam(':ordem', $ordem);            
            $stmt->bindParam(':menu', $menu);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':url', $url);
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
    public function alterar($idmenu, $idmodulos, $id_pai, $ordem, $menu, $class, $url) {
        try {
            $sql = 'update menu set idmenu=:idmenu,idmodulos=:idmodulos,id_pai=:id_pai, ordem=:ordem, menu=:menu,class=:class,url=:url where idmenu= :idmenu';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idmenu', $idmenu);
            $stmt->bindParam(':idmodulos', $idmodulos);
            $stmt->bindParam(':id_pai', $id_pai);
            $stmt->bindParam(':ordem', $ordem);            
            $stmt->bindParam(':menu', $menu);
            $stmt->bindParam(':class', $class);
            $stmt->bindParam(':url', $url);
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