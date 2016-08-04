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

class Usuarios {

//Atributos da classe
    private $idusuarios;
    private $usuario;
    private $senha;
    private $situacao;
    private $idperfil;
    private $dtreg;

    //Insert
    public function incluir($usuario, $senha, $situacao, $idperfil, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into usuarios(usuario,senha,situacao,idperfil,dtreg) values( :usuario, :senha, :situacao, :idperfil, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':situacao', $situacao);
            $stmt->bindParam(':idperfil', $idperfil);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'usuarios', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela usuarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idusuarios) {
        try {
            $sql = 'delete from usuarios where idusuarios= :idusuarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idusuarios', $idusuarios);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'usuarios', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela usuarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idusuarios, $usuario, $senha, $situacao, $idperfil, $dtreg) {
        try {
            $sql = 'update usuarios set idusuarios=:idusuarios,usuario=:usuario,senha=:senha,situacao=:situacao,idperfil=:idperfil,dtreg=:dtreg where idusuarios= :idusuarios';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':situacao', $situacao);
            $stmt->bindParam(':idperfil', $idperfil);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'usuarios', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela usuarios = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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