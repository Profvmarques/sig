<?php

session_start();
require_once('classes/menu.php');
require_once('classes/modulos.php');
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
            global $linha3;
            global $rs3;
            global $linha4;
            global $rs4;
            global $modulo;
            global $array;

            $menu->consultar("select * from sistemas order by descricao");
            $linha = $menu->Linha;
            $rs = $menu->Result;

            $menu->consultar("select * from modulos order by descricao");
            $linha1 = $menu->Linha;
            $rs1 = $menu->Result;
            if ($_POST['idmodulos'] != '') {

                $menu->consultar("select * from menu  inner join modulos ON(menu.idmodulos=modulos.idmodulos)
where menu.idmodulos=" . $_POST['idmodulos'] . " order by menu.ordem");
                $linha3 = $menu->Linha;
                $rs3 = $menu->Result;
                $modulos = new Modulos();
                $modulo = $modulos->obterDescricaoModulo($_POST['idmodulos']);

                for ($i = 0; $i < $linha3; $i++) {
                    $idmenuSubmissao = $rs3[$i]['idmenuSubmissao'];
                    $array[$i]['menu'] = $menu->obterDescricaoHierarquica($idmenuSubmissao);
                }

                $menu->consultar("select * from menu  inner join modulos ON(menu.idmodulos=modulos.idmodulos)
where menu.idmodulos=" . $_POST['idmodulos'] . " order by menu.ordem");
                $linha4 = $menu->Linha;
                $rs4 = $menu->Result;
            }

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar  
                    $menu->consultar('BEGIN');
                    $i = 0;
                    if (sizeof($_POST['id_pai']) > 0) {

                        foreach ($_POST['id_pai'] as $i => $v) {

                            $url['url'][$i] = 'default.php?pg=' . base64_encode($_POST['pagina']);
                            $url['url'][$i].='&titulo=' . base64_encode($_POST['titulo']);
                            $menu->incluir(
                                    $_POST['idmodulos'], $_POST['id_pai'][$i], $_POST['ordem'][$i], $_POST['menu'][$i], $_POST['class'][$i], $url['url'][$i], $_POST['idmenuSubmissao'][$i], 1);
                        }
                    }
                    $menu->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('visao/menu/consulta.php') . '&titulo=' . base64_encode('Consulta de Menu'));
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

            $menu = new Modulos();
            $menu->consultar("select * from modulos order by descricao");
            $linha1 = $menu->Linha;
            $rs1 = $menu->Result;


            if ($_POST['ok'] == 'true') {
                try {

                    $menu->consultar('BEGIN');
                    $url = 'default.php?pg=' . base64_encode($_POST['pagina']);
                    $url.='&titulo=' . base64_encode($_POST['titulo']);
                    $menu->alterar(
                            $_GET['id'], $_POST['idmodulos'], $_POST['id_pai'], $_POST['ordem'], $_POST['menu'], $_POST['class'], $url, $_POST['idmenuSubmissao'][$i]);

                    $descricao = "Atualização dos dados na tabela menu pelo usuário <b>" . $_SESSION['usuario'] . "</b> \n";
                    $funcionalidade = "Atualização de senha";
                    $data_hora = date('Y-m-d h:i:s');
                    $ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR', $data_hora);

                    $menu->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('visao/menu/consulta.php') . '&titulo=' . base64_encode('Consulta de Menu'));
                } catch (Exception $ex) {
                    $menu->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>