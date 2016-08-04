<?php

session_start();
require_once('classes/menu.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {
    /* Atributos Globais */
    $util = new Util();
    $menu = new Menu();
    $ocorrencias = new Ocorrencias();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            require_once('classes/modulos.php');
            global $linha1;
            global $rs1;

            $modulos = new Modulos();
            $modulos->consultar("select * from sistemas order by descricao");
            $linha = $modulos->Linha;
            $rs = $modulos->Result;            
            
            $modulos->consultar("select * from modulos order by descricao");
            $linha1 = $modulos->Linha;
            $rs1 = $modulos->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar  
                    $menu->consultar('BEGIN');
                    $menu->incluir(
                            $_POST['idmodulos'], $_POST['class'], $_POST['url'], $_POST['dtreg']
                    );
                    $menu->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/menu/consulta.php') . '&titulo=' . base64_encode('Consulta de Menu'));
                } catch (Exception $ex) {
                    $menu->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $menu->consultar('select * from menu order by descricao;');
            $linha = $menu->Linha;
            $rs = $menu->Result;

            if ($_POST['ok'] == 'true') {

                $menu->consultar("select * from menu where descricao like '%" . $_POST['descricao'] . "%' order by descricao");
                $linha = $menu->Linha;
                $rs = $menu->Result;
            }
            break;

        /* editar */
        case 'editar':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            require_once('classes/modulos.php');
            global $linhaEditar;
            global $rsEditar;
            global $linha1;
            global $rs1;

            $menu->consultar("select * from menu where idmenu = " . $_GET['id']);
            $linhaEditar = $menu->Linha;
            $rsEditar = $menu->Result;

            $modulos = new Modulos();
            $modulos->consultar("select * from modulos order by descricao");
            $linha1 = $modulos->Linha;
            $rs1 = $modulos->Result;


            if ($_POST['ok'] == 'true') {
                try {

                    $menu->consultar('BEGIN');
                    $menu->alterar(
                            $_GET['id'], $_POST['idmodulos'], $_POST['class'], $_POST['url'], $_POST['dtreg']
                    );
                    $descricao = "Atualização dos dados na tabela menu pelo usuário <b>" . $_SESSION['usuario'] . "</b> \n";
                    $funcionalidade = "Atualização de senha";
                    $data_hora = date('Y-m-d h:i:s');
                    $ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR', $data_hora);

                    $menu->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/menu/consulta.php') . '&titulo=' . base64_encode('Consulta de Menu'));
                } catch (Exception $ex) {
                    $menu->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>