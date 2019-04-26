<?php
include 'conexao.php';
class SQLMethods {
    
    public static function select($select) {
        $result = mysqli_query(Conexao::getConexao(),$select);
        return $result->fetch_all(MYSQLI_BOTH);
    }

    public static function insert($insert) {
        mysqli_query(Conexao::getConexao(), $insert);
    }
}