<?php
session_start();
require_once('classes/acessousuario.php');
require_once('classes/util.php');
require_once('classes/ocorrencias.php');

function Processo($Processo) {
    /* Atributos Globais */
    $util = new Util();
    $acessousuario = new AcessoUsuario();
    $ocorrencias = new Ocorrencias();

    /* Switch processos */
    switch ($Processo) {

        case 'menu':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
                    
            global $linha1;
            global $rs1;

            $usuarios = new Usuarios();
            $usuarios->consultar("select * from perfil inner join configuracao ON(perfil.idperfil=configuracao.idperfil) 
inner join menu on(menu.idmenu=configuracao.idmenu) 
inner join usuarios on (usuarios.idperfil=perfil.idperfil) 
inner join acessousuario on(acessousuario.idmenu=configuracao.idmenu and acessousuario.idusuarios=1) 
where menu.id_pai=0 and menu.publico=1 
and configuracao.publico=1 and acessousuario.publico=1 group by configuracao.idmenu ORDER BY menu.ordem");
            $linha1 = $usuarios->Linha;
            $rs1 = $usuarios->Result;

           
            break;

        /* incluir */
        case 'incluir':

            $util->seguranca($_SESSION['idusuarios'], 'index.php');
            global $linha;
            global $rs;
            require_once('classes/usuarios.php');
            global $linha1;
            global $rs1;

            $usuarios = new Usuarios();
            $usuarios->consultar("select * from usuarios order by descricao");
            $linha1 = $usuarios->Linha;
            $rs1 = $usuarios->Result;

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

            $usuarios = new Usuarios();
            $usuarios->consultar("select * from usuarios order by descricao");
            $linha1 = $usuarios->Linha;
            $rs1 = $usuarios->Result;


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