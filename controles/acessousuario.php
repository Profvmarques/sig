<?php

session_start();
require_once('classes/acessousuario.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

//echo "default.php?pg=".base64_encode('visao/menu/incluir.php')."&titulo=".  base64_encode('Cadastro de Menu');
function ProcessoAcessoUsuario($Processo) {
    /* Atributos Globais */
    $util = new Util();
    $acessousuario = new AcessoUsuario();
    $ocorrencias = new Ocorrencias();

    /* Switch processos */
    switch ($Processo) {

        case 'menu':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');

            global $linhaPai;
            global $rsPai;
            global $linhaSm1;
            global $rsSm1;
            global $linhaSm2;
            global $rsSm2;

            global $array;
            global $array1;
            global $array2;

            $acessousuario->consultar("select menu.idmenuSubmissao,menu.idmenu,menu.menu, menu.url,menu.class,menu.idmodulos,menu.class,menu.id_pai, menu.publico, 
menu.ordem, acessousuario.idusuarios as idusu, sistemas.idsistemas as idsis, acessousuario.incluir as aincluir, 
acessousuario.consultar as aconsultar, acessousuario.alterar as aalterar, acessousuario.excluir as aexcluir
from perfil inner join configuracao ON(perfil.idperfil=configuracao.idperfil) 
inner join menu on(menu.idmenu=configuracao.idmenu) 
inner join usuarios on (usuarios.idperfil=perfil.idperfil) 
inner join acessousuario on(acessousuario.idmenu=configuracao.idmenu and acessousuario.idusuarios=" . $_SESSION['idusuarios'] . ")  
inner join modulos on(modulos.idmodulos=menu.idmodulos) 
inner join sistemas on(sistemas.idsistemas=modulos.idsistemas) 
where menu.id_pai=0 and menu.publico=1 
and configuracao.permissao=1 and acessousuario.publico=1 group by configuracao.idmenu ORDER BY menu.ordem;");
            $linhaPai = $acessousuario->Linha;
            $rsPai = $acessousuario->Result;

            /* ----------------------------------------Menu pai ----------------------------------------------------------- */
            for ($i = 0; $i < $linhaPai; $i++) {
                $array[$i]['idmenu'] = $rsPai[$i]['idmenu'];
                $array[$i]['menu'] = ($rsPai[$i]['menu']);
                $array[$i]['url'] = $rsPai[$i]['url'];
                $array[$i]['class'] = $rsPai[$i]['class'];
                $array[$i]['idmodulos'] = $rsPai[$i]['idmodulos'];
                $array[$i]['class'] = $rsPai[$i]['class'];
                $array[$i]['idmenu'] = $rsPai[$i]['idmenu'];
                $array[$i]['id_pai'] = $rsPai[$i]['id_pai'];
                $array[$i]['publico'] = $rsPai[$i]['publico'];
                $array[$i]['ordem'] = $rsPai[$i]['ordem'];
                $array[$i]['idusuarios'] = $rsPai[$i]['idusu'];
                $array[$i]['idsistemas'] = $rsPai[$i]['idsis'];

                $array[$i]['Aincluir'] = $rsPai[$i]['aincluir'];
                $array[$i]['Aconsultar'] = $rsPai[$i]['aconsultar'];
                $array[$i]['Aalterar'] = $rsPai[$i]['aalterar'];
                $array[$i]['Aexcluir'] = $rsPai[$i]['aexcluir'];

                $array[$i]['Cincluir'] = $rsPai[$i]['cincluir'];
                $array[$i]['Cconsultar'] = $rsPai[$i]['cconsultar'];
                $array[$i]['Calterar'] = $rsPai[$i]['calterar'];
                $array[$i]['Cexcluir'] = $rsPai[$i]['cexcluir'];

                /* ---------------------------------subMenu1----------------------------------------------------- */
                $acessousuario->consultar("select menu.idmenuSubmissao,menu.idmenu,menu.menu, menu.url,menu.class,menu.idmodulos,menu.class,menu.id_pai, menu.publico, 
menu.ordem, acessousuario.idusuarios as idusu, sistemas.idsistemas as idsis, acessousuario.incluir as aincluir, 
acessousuario.consultar as aconsultar, acessousuario.alterar as aalterar, acessousuario.excluir as aexcluir 
from perfil inner join configuracao ON(perfil.idperfil=configuracao.idperfil) 
inner join menu on(menu.idmenu=configuracao.idmenu) 
inner join usuarios on (usuarios.idperfil=perfil.idperfil) 
inner join acessousuario on(acessousuario.idmenu=configuracao.idmenu and acessousuario.idusuarios=" . $_SESSION['idusuarios'] . ")  
inner join modulos on(modulos.idmodulos=menu.idmodulos) 
inner join sistemas on(sistemas.idsistemas=modulos.idsistemas) 
where menu.id_pai=1 and menu.publico=1 and menu.idmodulos=" . $array[$i]['idmodulos'] . " and modulos.idsistemas=" . $array[$i]['idsistemas'] . "
and configuracao.permissao=1 and acessousuario.publico=1 group by configuracao.idmenu ORDER BY menu.ordem;");
                $linhaSm1 = $acessousuario->Linha;
                $rsSm1 = $acessousuario->Result;

                for ($a = 0; $a < $linhaSm1; $a++) {
                    $array1[$a]['idmenu'] = $rsSm1[$a]['idmenu'];
                    $array1[$a]['idmenuSubmissao'] = $rsSm1[$a]['idmenuSubmissao'];
                    $array1[$a]['menu'] = ($rsSm1[$a]['menu']);
                    $array1[$a]['url'] = $rsSm1[$a]['url'];
                    $array1[$a]['class'] = $rsSm1[$a]['class'];
                    $array1[$a]['idmodulos'] = $rsSm1[$a]['idmodulos'];
                    $array1[$a]['class'] = $rsSm1[$a]['class'];
                    $array1[$a]['idmenu'] = $rsSm1[$a]['idmenu'];
                    $array1[$a]['id_pai'] = $rsSm1[$a]['id_pai'];
                    $array1[$a]['publico'] = $rsSm1[$a]['publico'];
                    $array1[$a]['ordem'] = $rsSm1[$a]['ordem'];
                    $array1[$a]['idusuarios'] = $rsSm1[$a]['idusu'];
                    $array1[$a]['idsistemas'] = $rsSm1[$a]['idsis'];

                    $array1[$a]['Aincluir'] = $rsSm1[$a]['aincluir'];
                    $array1[$a]['Aconsultar'] = $rsSm1[$a]['aconsultar'];
                    $array1[$a]['Aalterar'] = $rsSm1[$a]['aalterar'];
                    $array1[$a]['Aexcluir'] = $rsSm1[$a]['aexcluir'];

                    $array1[$a]['Cincluir'] = $rsSm1[$a]['cincluir'];
                    $array1[$a]['Cconsultar'] = $rsSm1[$a]['cconsultar'];
                    $array1[$a]['Calterar'] = $rsSm1[$a]['calterar'];
                    $array1[$a]['Cexcluir'] = $rsSm1[$a]['cexcluir'];

                    /* ---------------------------------subMenu2----------------------------------------------------- */
                    $acessousuario->consultar("select menu.idmenuSubmissao,menu.idmenu,menu.menu, menu.url,menu.class,menu.idmodulos,menu.class,menu.id_pai, menu.publico, 
menu.ordem, acessousuario.idusuarios as idusu, sistemas.idsistemas as idsis, acessousuario.incluir as aincluir, 
acessousuario.consultar as aconsultar, acessousuario.alterar as aalterar, acessousuario.excluir as aexcluir
from perfil inner join configuracao ON(perfil.idperfil=configuracao.idperfil) 
inner join menu on(menu.idmenu=configuracao.idmenu) 
inner join usuarios on (usuarios.idperfil=perfil.idperfil) 
inner join acessousuario on(acessousuario.idmenu=configuracao.idmenu and acessousuario.idusuarios=".$_SESSION['idusuarios'] . ")  
inner join modulos on(modulos.idmodulos=menu.idmodulos) 
inner join sistemas on(sistemas.idsistemas=modulos.idsistemas) 
where menu.id_pai=2 and menu.publico=1 and menu.idmodulos=" . $array1[$i]['idmodulos'] . " and modulos.idsistemas=" . $array1[$i]['idsistemas'] . "
and configuracao.permissao=1 and acessousuario.publico=1 group by configuracao.idmenu ORDER BY menu.ordem;");
                    $linhaSm2 = $acessousuario->Linha;
                    $rsSm2 = $acessousuario->Result;

                    for ($b = 0; $b < $linhaSm2; $b++) {
                        $array2[$b]['idmenu'] = $rsSm2[$b]['idmenu'];
                        $array2[$b]['idmenuSubmissao'] = $rsSm2[$b]['idmenuSubmissao'];
                        $array2[$b]['menu'] = ($rsSm2[$b]['menu']);
                        $array2[$b]['url'] = $rsSm2[$b]['url'];
                        $array2[$b]['class'] = $rsSm2[$b]['class'];
                        $array2[$b]['idmodulos'] = $rsSm2[$b]['idmodulos'];
                        $array2[$b]['class'] = $rsSm2[$b]['class'];
                        $array2[$b]['idmenu'] = $rsSm2[$b]['idmenu'];
                        $array2[$b]['id_pai'] = $rsSm2[$b]['id_pai'];
                        $array2[$b]['publico'] = $rsSm2[$b]['publico'];
                        $array2[$b]['ordem'] = $rsSm2[$b]['ordem'];
                        $array2[$b]['idusuarios'] = $rsSm2[$b]['idusu'];
                        $array2[$b]['idsistemas'] = $rsSm2[$b]['idsis'];

                        $array2[$b]['Aincluir'] = $rsSm2[$b]['aincluir'];
                        $array2[$b]['Aconsultar'] = $rsSm2[$b]['aconsultar'];
                        $array2[$b]['Aalterar'] = $rsSm2[$b]['aalterar'];
                        $array2[$b]['Aexcluir'] = $rsSm2[$b]['aexcluir'];

                        $array2[$b]['Cincluir'] = $rsSm2[$b]['cincluir'];
                        $array2[$b]['Cconsultar'] = $rsSm2[$b]['cconsultar'];
                        $array2[$b]['Calterar'] = $rsSm2[$b]['calterar'];
                        $array2[$b]['Cexcluir'] = $rsSm2[$b]['cexcluir'];
                    }
                }
            }
            
            break;

        /* incluir */
        case 'incluir':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            require_once('classes/usuarios.php');
            global $linha1;
            global $rs1;

            $acessousuario = new Usuarios();
            $acessousuario->consultar("select * from usuarios order by descricao");
            $linha1 = $acessousuario->Linha;
            $rs1 = $acessousuario->Result;

            if ($_POST['ok'] == 'true') {
                try {
                    //Chamar  
                    $acessousuario->consultar('BEGIN');
                    $acessousuario->incluir(
                            $_POST['idusuarios'], $_POST['incluir'], $_POST['consultar'], $_POST['alterar'], $_POST['excluir']
                    );
                    $acessousuario->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/acessousuario/consulta.php') . '&titulo=' . base64_encode('Consulta de Acessousuario'));
                } catch (Exception $ex) {
                    $acessousuario->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;

        case 'consulta':
            global $linha;
            global $rs;
            $acessousuario->consultar('select * from acessousuario order by descricao;');
            $linha = $acessousuario->Linha;
            $rs = $acessousuario->Result;

            if ($_POST['ok'] == 'true') {

                $acessousuario->consultar("select * from acessousuario where descricao like '%" . $_POST['descricao'] . "%' order by descricao");
                $linha = $acessousuario->Linha;
                $rs = $acessousuario->Result;
            }
            break;

        /* editar */
        case 'editar':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            require_once('classes/usuarios.php');
            global $linhaEditar;
            global $rsEditar;
            global $linha1;
            global $rs1;

            $acessousuario->consultar("select * from acessousuario where idmenu = " . $_GET['id']);
            $linhaEditar = $acessousuario->Linha;
            $rsEditar = $acessousuario->Result;

            $acessousuario = new Usuarios();
            $acessousuario->consultar("select * from usuarios order by descricao");
            $linha1 = $acessousuario->Linha;
            $rs1 = $acessousuario->Result;


            if ($_POST['ok'] == 'true') {
                try {

                    $acessousuario->consultar('BEGIN');
                    $acessousuario->alterar(
                            $_GET['id'], $_POST['idusuarios'], $_POST['incluir'], $_POST['consultar'], $_POST['alterar'], $_POST['excluir']
                    );
                    $descricao = "Atualização dos dados na tabela acessousuario pelo usuário <b>" . $_SESSION['usuario'] . "</b> \n";
                    $funcionalidade = "Atualização de senha";
                    $data_hora = date('Y-m-d h:i:s');
                    $ocorrencias->incluir($_SESSION['idusuarios'], utf8_decode($descricao), utf8_decode($funcionalidade), 'A VALIDAR', $data_hora);

                    $acessousuario->consultar('COMMIT');
                    $util->msgbox('REGISTRO SALVO COM SUCESSO!');
                    $util->redirecionamentopage('default.php?pg=' . base64_encode('view/acessousuario/consulta.php') . '&titulo=' . base64_encode('Consulta de Acessousuario'));
                } catch (Exception $ex) {
                    $acessousuario->consultar('ROLLBACK');
                    $util->msgbox('Falha de operacao');
                }
            }
            break;
    }
}

?>