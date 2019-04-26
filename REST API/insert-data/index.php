<?php

include '../SQLMethods.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['data']) && is_numeric($_GET['data']) && isset($_GET['key']) && $_GET['key'] == 'ic2018') {
        SQLMethods::insert("INSERT INTO DADOS (concentracao, data_hora) VALUES ({$_GET['data']}, NOW())");
        http_response_code(200); // OK
    } else {
        http_response_code(400); // Erro de sintaxe
    }
} else {
    http_response_code(405); //Método não permitido
}