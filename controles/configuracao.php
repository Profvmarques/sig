<?php

session_start();
require_once('classes/configuracao.php');
require_once('classes/acessousuario.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {
    /* Atributos Globais */
    $util = new Util();
    $configuracao = new Configuracao();
    $acessoUsuario = new AcessoUsuario();
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
            }
            //print_r($array);exit; 
            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar  
                    $configuracao->consultar('BEGIN');
                    if (sizeof($_POST['idmenu']) > 0) {
                        /* Para configuraçãop de acesso de usuarios mediante perfil */
                        for ($i = 0; $i < $linha2; $i++) {
                            $idmenu = $rs2[$i]['idmenu'];
                            $permissao = $rs2[$i]['permissao'];
                            $configuracao->obterConfiguracao($idmenu, $_POST['idperfil']);
                            if ($configuracao->achou == 'NAO') {
                                $configuracao->incluir($idmenu, $_POST['idperfil'], $permissao);
                            }

                            /* Para permissao de acesso de usuarios */
                            $configuracao->consultar("select m.idmenu as idMenu, u.idusuarios as idUsuarios from configuracao c inner JOIN menu m on(c.idmenu=m.idmenu) 
inner join perfil p on(p.idperfil=c.idperfil) 
inner join usuarios u on(u.idperfil=p.idperfil) 
where p.idperfil=".$_POST['idperfil']);
                            $linha3 = $configuracao->Linha;
                            $rs3 = $configuracao->Result;

                            for ($i = 0; $i < $linha3; $i++) {
                                $idusuarios = $rs3[$i]['idUsuarios'];
                                $idMenu = $rs3[$i]['idMenu'];
                                //$permissao = $rs2[$i]['permissao'];
                                $acessoUsuario->obterAcessoUsuario($idmenu, $idusuarios);
                                if ($acessoUsuario->achou == 'NAO') {
                                    $acessoUsuario->incluir($idmenu, $idMenu, 1,1,1,1);
                                }
                            }
                        }
                    }

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
                } catch (Exception $ex) {
                    $configuracao->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>