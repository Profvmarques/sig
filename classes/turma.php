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

class Turma {

//Atributos da classe
    private $idturma;
    private $codigo;
    private $idcursos;
    private $horario_inicio;
    private $horario_termino;
    private $seg;
    private $ter;
    private $qua;
    private $qui;
    private $sex;
    private $sab;
    private $dom;
    private $idturno;
    private $idsituacao_turma;

    //Insert
    public function incluir($codigo, $idcursos, $horario_inicio, $horario_termino, $seg, $ter, $qua, $qui, $sex, $sab, $dom, $idturno, $idsituacao_turma) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into turma(codigo,idcursos,horario_inicio,horario_termino,seg,ter,qua,qui,sex,sab,dom,idturno,idsituacao_turma) values( :codigo, :idcursos, :horario_inicio, :horario_termino, :seg, :ter, :qua, :qui, :sex, :sab, :dom, :idturno, :idsituacao_turma);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':codigo', $codigo);
            $stmt->bindParam(':idcursos', $idcursos);
            $stmt->bindParam(':horario_inicio', $horario_inicio);
            $stmt->bindParam(':horario_termino', $horario_termino);
            $stmt->bindParam(':seg', $seg);
            $stmt->bindParam(':ter', $ter);
            $stmt->bindParam(':qua', $qua);
            $stmt->bindParam(':qui', $qui);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':sab', $sab);
            $stmt->bindParam(':dom', $dom);
            $stmt->bindParam(':idturno', $idturno);
            $stmt->bindParam(':idsituacao_turma', $idsituacao_turma);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'turma', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela turma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idturma) {
        try {
            $sql = 'delete from turma where idturma= :idturma';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idturma', $idturma);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'turma', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela turma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idturma, $codigo, $idcursos, $horario_inicio, $horario_termino, $seg, $ter, $qua, $qui, $sex, $sab, $dom, $idturno, $idsituacao_turma) {
        try {
            $sql = 'update turma set idturma=:idturma,codigo=:codigo,idcursos=:idcursos,horario_inicio=:horario_inicio,horario_termino=:horario_termino,seg=:seg,ter=:ter,qua=:qua,qui=:qui,sex=:sex,sab=:sab,dom=:dom,idturno=:idturno,idsituacao_turma=:idsituacao_turma where idturma= :idturma';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idturma', $idturma);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->bindParam(':idcursos', $idcursos);
            $stmt->bindParam(':horario_inicio', $horario_inicio);
            $stmt->bindParam(':horario_termino', $horario_termino);
            $stmt->bindParam(':seg', $seg);
            $stmt->bindParam(':ter', $ter);
            $stmt->bindParam(':qua', $qua);
            $stmt->bindParam(':qui', $qui);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':sab', $sab);
            $stmt->bindParam(':dom', $dom);
            $stmt->bindParam(':idturno', $idturno);
            $stmt->bindParam(':idsituacao_turma', $idsituacao_turma);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'turma', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela turma = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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