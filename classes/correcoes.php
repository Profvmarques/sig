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

class Correcoes {

//Atributos da classe
    private $idcorrecoes;
    private $assunto;
    private $foto;
    private $observacao;
    private $situacao;
    private $dtreg;

    //Insert
    public function incluir($assunto, $foto, $observacao, $situacao, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into correcoes(assunto,foto,observacao,situacao,dtreg) values( :assunto, :foto, :observacao, :situacao, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':observacao', $observacao);
            $stmt->bindParam(':situacao', $situacao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'correcoes', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela correcoes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idcorrecoes) {
        try {
            $sql = 'delete from correcoes where idcorrecoes= :idcorrecoes';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcorrecoes', $idcorrecoes);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'correcoes', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela correcoes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idcorrecoes, $assunto, $foto, $observacao, $situacao, $dtreg) {
        try {
            $sql = 'update correcoes set idcorrecoes=:idcorrecoes,assunto=:assunto,foto=:foto,observacao=:observacao,situacao=:situacao,dtreg=:dtreg where idcorrecoes= :idcorrecoes';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcorrecoes', $idcorrecoes);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':observacao', $observacao);
            $stmt->bindParam(':situacao', $situacao);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'correcoes', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela correcoes = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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