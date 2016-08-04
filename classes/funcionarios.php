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

class Funcionarios {

//Atributos da classe
    private $idfuncionarios;
    private $idpessoas;
    private $idcargos;
    private $dtreg;

    //Insert
    public function incluir($idpessoas, $idcargos, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into funcionarios(idpessoas,idcargos,dtreg) values( :idpessoas, :idcargos, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':idcargos', $idcargos);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'funcionarios', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela funcionarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idfuncionarios) {
        try {
            $sql = 'delete from funcionarios where idfuncionarios= :idfuncionarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfuncionarios', $idfuncionarios);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'funcionarios', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela funcionarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idfuncionarios, $idpessoas, $idcargos, $dtreg) {
        try {
            $sql = 'update funcionarios set idfuncionarios=:idfuncionarios,idpessoas=:idpessoas,idcargos=:idcargos,dtreg=:dtreg where idfuncionarios= :idfuncionarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idfuncionarios', $idfuncionarios);
            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':idcargos', $idcargos);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'funcionarios', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela funcionarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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