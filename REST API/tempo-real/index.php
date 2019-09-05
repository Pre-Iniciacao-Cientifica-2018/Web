<?php
include '../SQLMethods.php';

$data = SQLMethods::select("SELECT concentracao FROM DADOS ORDER BY data_hora desc LIMIT 1");
$json = array();
$json["data"] = array();
if ($data != null) {
    $json["data"] = ['tempo-real' => $data[0][0]];
} else {
    $json["data"] = ['erro' => 'Não foi possível acessar o banco de dados'];
    http_response_code(500);
}
header_remove();
header('Content-Type: application/json');
echo json_encode($json);