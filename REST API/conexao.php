<?php
  
class Conexao
{
    public static function getConexao() {
        $conn = mysqli_connect('localhost', 'root', '', 'banco');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}