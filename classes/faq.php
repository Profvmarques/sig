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

class Faq {

//Atributos da classe
    private $idfaq;
    private $titulo;
    private $resposta;
    private $idusuarios;
    private $dtreg;

    //Insert
    public function incluir($titulo, $resposta, $idusuarios, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into faq(titulo,resposta,idusuarios,dtreg) values( :titulo, :resposta, :idusuarios, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':resposta', $resposta);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'faq', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela faq = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idfaq) {
        try {
            $sql = 'delete from faq where idfaq= :idfaq';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfaq', $idfaq);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'faq', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela faq = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idfaq, $titulo, $resposta, $idusuarios, $dtreg) {
        try {
            $sql = 'update faq set idfaq=:idfaq,titulo=:titulo,resposta=:resposta,idusuarios=:idusuarios,dtreg=:dtreg where idfaq= :idfaq';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfaq', $idfaq);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':resposta', $resposta);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'faq', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela faq = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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