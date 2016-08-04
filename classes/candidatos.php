<?php
require_once('acesso.php');
require_once('logs.php');

class Candidatos {

//Atributos da classe
    private $idcandidatos;
    private $idpessoas;
    private $dtreg;

    //Insert
    public function incluir($idpessoas, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into candidatos(idpessoas,dtreg) values( :idpessoas, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'candidatos', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela candidatos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idcandidatos) {
        try {
            $sql = 'delete from candidatos where idcandidatos= :idcandidatos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcandidatos', $idcandidatos);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'candidatos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela candidatos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idcandidatos, $idpessoas, $dtreg) {
        try {
            $sql = 'update candidatos set idcandidatos=:idcandidatos,idpessoas=:idpessoas,dtreg=:dtreg where idcandidatos= :idcandidatos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcandidatos', $idcandidatos);
            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'candidatos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela candidatos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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