<?php
session_start();
require_once('classes/ocorrencias.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {
    /* Atributos Globais */
    $util = new Util();


    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
           
            $ocorrencias = new Ocorrencias();
            if ($_SESSION['idperfil'] == 1) {
                $ocorrencias->consultar("select *, date_format(dtreg,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias where situacao<>'VALIDADA' order by dtreg desc");
                $linha = $ocorrencias->Linha;
                $rs = $ocorrencias->Result;
            } else {

                $ocorrencias->consultar("select *,date_format(o.dtreg,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias o inner join usuarios u on(o.idusuarios = u.idusuarios) "
                        . "inner join perfil p on(u.idperfil=p.idperfil) where o.situacao<>'VALIDADA' and u.idperfil<>1");
                $linha = $ocorrencias->Linha;
                $rs = $ocorrencias->Result;
            }

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar  
                    $ocorrencias->consultar('BEGIN');
                    $ocorrencias->incluir(
                            $_POST['idusuarios'], $_POST['query_executada'], $_POST['tabela'], $_POST['acao'], $_POST['dtreg']
                    );
                    $ocorrencias->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/ocorrencias/consulta.php') . '&titulo=' . base64_encode('Consulta de Ocorrencias'));
                } catch (Exception $ex) {
                    $ocorrencias->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;

            $ocorrencias = new Ocorrencias();
            $ocorrencias->consultar("select *, date_format(dtreg,'%d/%m/%Y %H:%i:%s') as dh from ocorrencias where situacao<>'VALIDADA' order by dtreg desc");
            $linha = $ocorrencias->Linha;
            $rs = $ocorrencias->Result;

            break;

        /* editar */
        case 'editar':
            $ocorrencias = new Ocorrencias();

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            require_once('classes/usuarios.php');
            global $linhaEditar;
            global $rsEditar;
            global $linha1;
            global $rs1;

            $ocorrencias->consultar("select * from ocorrencias where idocorrencias = " . $_GET['id']);
            $linhaEditar = $ocorrencias->Linha;
            $rsEditar = $ocorrencias->Result;

            $usuarios = new Usuarios();
            $usuarios->consultar("select * from usuarios order by descricao");
            $linha1 = $usuarios->Linha;
            $rs1 = $usuarios->Result;


            if ($_POST['ok'] == 'true') {
                try {

                    $ocorrencias->consultar('BEGIN');
                    $ocorrencias->alterar(
                            $_GET['id'], $_POST['idusuarios'], $_POST['query_executada'], $_POST['tabela'], $_POST['acao'], $_POST['dtreg']
                    );
                    $descricao = "Atualização dos dados na tabela ocorrencias pelo usuário <b>" . $_SESSION['usuario'] . "</b> \n";
                    $funcionalidade = "Atualização de senha";
                    $data_hora = date('Y-m-d h:i:s');
                    $ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR', $data_hora);

                    $ocorrencias->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('visao/ocorrencias/consulta.php') . '&titulo=' . base64_encode('Consulta de Ocorrencias'));
                } catch (Exception $ex) {
                    $ocorrencias->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>