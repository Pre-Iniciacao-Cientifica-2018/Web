<?php
require_once '../Conexao.php';
require_once '../SQLMethods.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['data']) && is_numeric($_GET['data'])) {
        SQLMethods::defineCredentials();
        SQLMethods::insert("INSERT INTO DADOS VALUES ({$_GET['data']}, '".date('Ymd h:i:s a', time()). "')");
        http_response_code(200); // OK
    } else {
        http_response_code(400); // Erro de sintaxe
    }
} else {
    http_response_code(405); //Método não permitido
}