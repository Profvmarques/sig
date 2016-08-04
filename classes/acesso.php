<?php

class Acesso {
    /*Fonte de consulta
     * *http://www.linhadecomando.com/php/php-mysql-contando-o-resultado-de-uma-consulta-via-pdo
     * *http://rberaldo.com.br/pdo-mysql/
     */

    private $host = 'mysql.fundec.rj.gov.br';
    private $usuario = 'fundec26';
    private $senha = 'sysfundec26';
    private $banco = 'fundec26';

    function getHost() {
        return $this->host;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getSenha() {
        return $this->senha;
    }

    function getBanco() {
        return $this->banco;
    }

    public function conexao() {

        try {
            $pdo = new PDO('mysql:host=' .$this->getHost(). ';dbname=' . $this->getBanco(), $this->getUsuario(), $this->getSenha());
            return $pdo;
        } catch (PDOException $e) {
            echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
        }
    }

    public function query($sql) {
        $pdo = $this->conexao();
        $rs =$pdo->query($sql);
        if(!$rs){
            echo " <b>Reveja a consulta (SQL): </b>".$sql;
        }
        $this->result = $rs->fetchAll();
        $this->linha = $rs->rowCount();        
        
    }
	
	public function execute($sql) {
        $pdo = $this->conexao();
        $rs=$pdo->prepare($sql);
        //$this->linha = $rs->rowCount();        
        
    }

    public function __destruct() {
        @mysqli_close($this->cnx);
    }

}
?>