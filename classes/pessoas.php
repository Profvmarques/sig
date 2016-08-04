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

class Pessoas {

//Atributos da classe
    private $idpessoas;
    private $nome;
    private $sexo;
    private $nascimento;
    private $email;
    private $telefone;
    private $celular;
    private $pai;
    private $mae;
    private $responsavel;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $cidade;
    private $cep;
    private $foto;
    private $idusuarios;
    private $dtreg;

    //Insert
    public function incluir($nome, $sexo, $nascimento, $email, $telefone, $celular, $pai, $mae, $responsavel, $endereco, $numero, $complemento, $bairro, $cidade, $cep, $foto, $idusuarios, $dtreg) {
        try {
            $dtreg = date('Y-m-d h:i:s');
            $sql = 'insert into pessoas(nome,sexo,nascimento,email,telefone,celular,pai,mae,responsavel,endereco,numero,complemento,bairro,cidade,cep,foto,idusuarios,dtreg) values( :nome, :sexo, :nascimento, :email, :telefone, :celular, :pai, :mae, :responsavel, :endereco, :numero, :complemento, :bairro, :cidade, :cep, :foto, :idusuarios, :dtreg);';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();
            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':nascimento', $nascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':pai', $pai);
            $stmt->bindParam(':mae', $mae);
            $stmt->bindParam(':responsavel', $responsavel);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'pessoas', 'Inserir');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela pessoas = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //excluir
    public function excluir($idpessoas) {
        try {
            $sql = 'delete from pessoas where idpessoas= :idpessoas';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idpessoas', $idpessoas);

            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'pessoas', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela pessoas = ' . $sql . '</b> <br /><br />' . $e->getMessage();
        }
    }

    //Editar
    public function alterar($idpessoas, $nome, $sexo, $nascimento, $email, $telefone, $celular, $pai, $mae, $responsavel, $endereco, $numero, $complemento, $bairro, $cidade, $cep, $foto, $idusuarios, $dtreg) {
        try {
            $sql = 'update pessoas set idpessoas=:idpessoas,nome=:nome,sexo=:sexo,nascimento=:nascimento,email=:email,telefone=:telefone,celular=:celular,pai=:pai,mae=:mae,responsavel=:responsavel,endereco=:endereco,numero=:numero,complemento=:complemento,bairro=:bairro,cidade=:cidade,cep=:cep,foto=:foto,idusuarios=:idusuarios,dtreg=:dtreg where idpessoas= :idpessoas';
            $sql = str_replace("'", "\'", $sql);
            $acesso = new Acesso();


            $pdo = $acesso->conexao();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':idpessoas', $idpessoas);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':sexo', $sexo);
            $stmt->bindParam(':nascimento', $nascimento);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':pai', $pai);
            $stmt->bindParam(':mae', $mae);
            $stmt->bindParam(':responsavel', $responsavel);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':idusuarios', $idusuarios);
            $stmt->bindParam(':dtreg', $dtreg);
            $stmt->execute();

            $logs = new Logs();
            $logs->incluir($_SESSION['idusuarios'], $sql, 'pessoas', 'Alterar');
        } catch (PDOException $e) {
            echo 'Error: <b>  na tabela pessoas = ' . $sql . '</b> <br /><br />' . $e->getMessage();
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