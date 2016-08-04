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

class Eventos {

//Atributos da classe
    private $ideventos;
    private $descricao;
    private $data_inicio;
    private $data_termino;

    //Insert
    public function incluir($descricao, $data_inicio, $data_termino) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into eventos(descricao,data_inicio,data_termino) values( :descricao, :data_inicio, :data_termino);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_termino', $data_termino);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'eventos', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela eventos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($ideventos) {
        try {
            $sql = 'delete from eventos where ideventos= :ideventos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':ideventos', $ideventos);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'eventos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela eventos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($ideventos, $descricao, $data_inicio, $data_termino) {
        try {
            $sql = 'update eventos set ideventos=:ideventos,descricao=:descricao,data_inicio=:data_inicio,data_termino=:data_termino where ideventos= :ideventos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':ideventos', $ideventos);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_termino', $data_termino);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'eventos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela eventos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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