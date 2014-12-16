<?php

//ini_set('default_charset', 'UTF-8');

class ClsConn {
    static function getConn() {
        #Read more: http://www.linhadecodigo.com.br/artigo/3638/php-pdo-como-se-conectar-ao-banco-de-dados.aspx#ixzz3BAZph0b6
        $servidor = "localhost";
        $database = "inprov";
        $usuario = "root";
        $senha = "";

        try {
            $conn = new PDO("mysql:host=$servidor;dbname=$database;charset=utf8", $usuario, $senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            return 'ERROR: ' . $e->getMessage();
        }
    }
}

?>