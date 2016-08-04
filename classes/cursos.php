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

class Cursos {

//Atributos da classe
    private $idcursos;
    private $idsituacao_curso;
    private $sigla;
    private $descricao;
    private $carga_horaria;
    private $idtipocurso;

    //Insert
    public function incluir($idsituacao_curso, $sigla, $descricao, $carga_horaria, $idtipocurso) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into cursos(idsituacao_curso,sigla,descricao,carga_horaria,idtipocurso) values( :idsituacao_curso, :sigla, :descricao, :carga_horaria, :idtipocurso);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idsituacao_curso', $idsituacao_curso);
            $stmt->bindParam(':sigla', $sigla);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':carga_horaria', $carga_horaria);
            $stmt->bindParam(':idtipocurso', $idtipocurso);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'cursos', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela cursos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idcursos) {
        try {
            $sql = 'delete from cursos where idcursos= :idcursos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcursos', $idcursos);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'cursos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela cursos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idcursos, $idsituacao_curso, $sigla, $descricao, $carga_horaria, $idtipocurso) {
        try {
            $sql = 'update cursos set idcursos=:idcursos,idsituacao_curso=:idsituacao_curso,sigla=:sigla,descricao=:descricao,carga_horaria=:carga_horaria,idtipocurso=:idtipocurso where idcursos= :idcursos';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idcursos', $idcursos);
            $stmt->bindParam(':idsituacao_curso', $idsituacao_curso);
            $stmt->bindParam(':sigla', $sigla);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':carga_horaria', $carga_horaria);
            $stmt->bindParam(':idtipocurso', $idtipocurso);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'cursos', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela cursos = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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