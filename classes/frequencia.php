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

class Frequencia {

//Atributos da classe
    private $idfrequencia;
    private $idturma;
    private $data_frequencia;
    private $dtreg;

    //Insert
    public function incluir($idturma, $data_frequencia, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into frequencia(idturma,data_frequencia,dtreg) values( :idturma, :data_frequencia, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idturma', $idturma);
            $stmt->bindParam(':data_frequencia', $data_frequencia);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'frequencia', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela frequencia = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idfrequencia) {
        try {
            $sql = 'delete from frequencia where idfrequencia= :idfrequencia';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfrequencia', $idfrequencia);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'frequencia', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela frequencia = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idfrequencia, $idturma, $data_frequencia, $dtreg) {
        try {
            $sql = 'update frequencia set idfrequencia=:idfrequencia,idturma=:idturma,data_frequencia=:data_frequencia,dtreg=:dtreg where idfrequencia= :idfrequencia';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfrequencia', $idfrequencia);
            $stmt->bindParam(':idturma', $idturma);
            $stmt->bindParam(':data_frequencia', $data_frequencia);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'frequencia', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela frequencia = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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