<?php
session_start();
require_once('classes/usuarios.php');
require_once('classes/util.php');

/* Function Processos */
global $Adm_acesso_usuario;

function Processo($Processo) {


    /* Switch processos */
    switch ($Processo) {
        /* login de identificação */
        case 'login':
            /* Atributos Globais */
            $util = new Util();
            $usuarios = new Usuarios();

           
            if ($_POST['ok'] == 'true') {
                $sql = "select * from usuarios where usuario='" . $_POST['usuario'] . "' and senha='" . base64_encode($_POST['senha']) . "'";
                $usuarios->consultar($sql);
                $rs = $usuarios->Result;
                $linha = $usuarios->Linha;
                if ($linha > 0) {
                    $_SESSION['idusuarios'] = $rs[0]['idusuarios'];
                    $_SESSION['idperfil'] = $rs[0]['idperfil'];
                    //$_SESSION['nome'] = $rs[0]['nome'];
                    $_SESSION['usuario'] = $rs[0]['usuario'];
                    $_SESSION['idsistemas'] = 0;
                    

                    /*$pg = base64_encode("visao/ocorrencias/ocorrencias.php");
                    $titulo = base64_encode("Ocorr&ecirc;ncias que merecem aten&ccedil;&atilde;o");
                    $pg = base64_encode("visao/ocorrencias/ocorrencias.php");*/
                    
                    $pg = base64_encode("visao/painel/incluirAdm.php");
                    $titulo = base64_encode("Painel de Sistemas");
                    
                    $util->redirecionamentopage("default.php?pg=" . $pg . "&titulo=" . $titulo);exit;
                } else {
                    $util->msgbox("Login ou senha errado!");
                }
            }
            break;

        case 'esqueceuSenha':
            /* Atributos Globais */
            require_once('classes/usuarios.php');
            $usuarios = new Usuarios();
            $util = new Util();
            $usuarios = new Adm_acesso_usuario();

            if ($_POST['ok'] == 'true') {
                $sql = "select * from usuarios u inner join pessoas p
                             on(u.idusuarios=p.idusuarios) inner join perfil on(u.idperfil=perfil.idperfil) where p.email='" . trim($_POST['email']) . "'";
                $usuarios->consultar($sql);
                $rs = $usuarios->Result;
                $linha = $usuarios->Linha;
                if ($linha > 0) {
                    $login = mysql_result($rs, 0, 'u.usuario');
                    $senha = mysql_result($rs, 0, 'u.senha');
                    $perfil = mysql_result($rs, 0, 'perfil.descricao');

                    $usuarios->EnviarEmail($login, $senha, $_POST['email'], $perfil);
                    $util->MsgboxSimNaoNovoCad("Os dados de autenticação de acesso do sysduque foi enviado para o seguinte e-mail :" . $_POST['email'], "index.php");
                    $util->redirecionamentopage("index.php");
                } else {
                    $util->msgbox("O e-mail informado não foi encontrado, por favor entre em contato com a secretaria!");
                }
            }
            break;
        case 'logoff':
            $util = new Util();
            @session_destroy();
            $util->redirecionamentopage("index.php");

            break;
    }
}

?>