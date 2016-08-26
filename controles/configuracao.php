<?php

session_start();
require_once('classes/configuracao.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {
    /* Atributos Globais */
    $util = new Util();
    $configuracao = new Configuracao();
    $ocorrencias = new Ocorrencias();

    /* Switch processos */
    switch ($Processo) {
        /* incluir */
        case 'incluir':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            global $linha1;
            global $rs1;
            global $linha2;
            global $rs2;
            global $array;
            $array = array();

            $configuracao->consultar("select * from sistemas order by descricao");
            $linha = $configuracao->Linha;
            $rs = $configuracao->Result;

            $configuracao->consultar("select * from perfil order by descricao");
            $linha1 = $configuracao->Linha;
            $rs1 = $configuracao->Result;

            if ($_POST['acao'] == 'consultar') {
                $configuracao->consultar("select modulos.descricao as modulo, configuracao.permissao, menu.* from perfil inner join configuracao on(configuracao.idperfil=perfil.idperfil) 
inner join menu on(menu.idmenu=configuracao.idmenu) 
inner join modulos on(modulos.idmodulos=menu.idmodulos) 
where configuracao.idperfil=" . $_POST['idperfil'] . " and modulos.idsistemas=" . $_POST['idsistemas'] . "
order by modulos.idmodulos,menu.ordem;");
                $linha2 = $configuracao->Linha;
                $rs2 = $configuracao->Result;
                $_POST['acao'] = '';

                if ($linha2 > 0) {
                    for ($i = 0; $i < $linha2; $i++) {
                        $array[$i]['idmodulos'] = $rs2[$i]['idmodulos'];
                        if ($i <= 0) {
                            $array[$i]['idmodulos'] = $rs2[$i]['idmodulos'];
                        } else {
                            $array[$i]['idmodulos'] = 0;
                        }
                        $array[$i]['modulo'] = $rs2[$i]['modulo'];
                        $array[$i]['idmenu'] = $rs2[$i]['idmenu'];
                        $array[$i]['menu'] = $rs2[$i]['menu'];
                        $array[$i]['permissao'] = $rs2[$i]['permissao'];
                    }
                }
            }
            //print_r($array);exit; 
            if ($_POST['ok'] == 'true'){
                try {
                    //Chamar  
                    $configuracao->consultar('BEGIN');
                    $configuracao->incluir(
                            $_POST['incluir'], $_POST['consultar'], $_POST['alterar'], $_POST['excluir'], $_POST['publico']
                    );
                    $configuracao->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('visao/configuracao/consulta.php') . '&titulo=' . base64_encode('Consulta de Configuração'));
                } catch (Exception $ex) {
                    $configuracao->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $configuracao->consultar('select * from configuracao order by descricao;');
            $linha = $configuracao->Linha;
            $rs = $configuracao->Result;

            if ($_POST['ok'] == 'true') {

                $configuracao->consultar("select * from configuracao where descricao like '%" . $_POST['descricao'] . "%' order by descricao");
                $linha = $configuracao->Linha;
                $rs = $configuracao->Result;
            }
            break;

        /* editar */
        case 'editar':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linhaEditar;
            global $rsEditar;

            $configuracao->consultar("select * from configuracao where idperfil = " . $_GET['id']);
            $linhaEditar = $configuracao->Linha;
            $rsEditar = $configuracao->Result;


            if ($_POST['ok'] == 'true') {
                try {

                    $configuracao->consultar('BEGIN');
                    $configuracao->alterar(
                            $_GET['id'], $_POST['incluir'], $_POST['consultar'], $_POST['alterar'], $_POST['excluir'], $_POST['publico']
                    );
                    $descricao = "Atualização dos dados na tabela configuracao pelo usuário <b>" . $_SESSION['usuario'] . "</b> \n";
                    $funcionalidade = "Atualização de senha";
                    $data_hora = date('Y-m-d h:i:s');
                    $ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR', $data_hora);

                    $configuracao->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/configuracao/consulta.php') . '&titulo=' . base64_encode('Consulta de Configuracao'));
                } catch(Exception $ex) {
                    $configuracao->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>