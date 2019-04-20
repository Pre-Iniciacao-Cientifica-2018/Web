<?php
  
class Conexao
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "banco";

    public function getConexao() {
        $conn = mysqli_connect('localhost', 'root', '', 'banco');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
}