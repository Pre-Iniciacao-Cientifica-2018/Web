<?php
require_once('Conexao.php');

class SQLMethods {
    
    public static function defineCredentials() {
        define('DB_HOST'        , "localhost");
        define('DB_USER'        , "sa");
        define('DB_PASSWORD'    , "12345");
        define('DB_NAME'        , "BANCO");
        define('DB_DRIVER'      , "sqlsrv");
    }

    public static function select($select) {
        $Conexao = Conexao::getConnection();
        $query = $Conexao->query($select);
        return $query->fetchAll();
    }

    public static function insert($insert) {
        $Conexao = Conexao::getConnection();
        $query = $Conexao->prepare($insert);
        $query->execute();
    }
}