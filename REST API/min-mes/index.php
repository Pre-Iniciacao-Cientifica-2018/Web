<?php
include '../SQLMethods.php';

$data = SQLMethods::select("SELECT min(concentracao) FROM DADOS WHERE MONTH(data_hora) = MONTH(NOW())");
$json = array();
$json["data"] = array();
if ($data != null) {
    $json["data"] = ['min-con' => $data[0][0]];
} else {
    $json["data"] = ['erro' => 'Não foi possível acessar o banco de dados'];
    http_response_code(500);
}
header_remove();
header('Content-Type: application/json');
echo json_encode($json);