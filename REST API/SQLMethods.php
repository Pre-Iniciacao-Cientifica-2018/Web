<?php
include 'Conexao.php';

class SQLMethods {
    
    public static function select($select) {
        $result = mysqli_query(Conexao::getConexao(),$select);
        return $result->fetch_all(MYSQLI_BOTH);
    }

    public static function insert($insert) {
        $Conexao = Conexao::getConnection();
        $query = $Conexao->prepare($insert);
        $query->execute();
    }
}