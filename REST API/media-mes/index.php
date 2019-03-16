<?php
include_once '../Conexao.php';
include_once '../SQLMethods.php';

SQLMethods::defineCredentials();

$data = SQLMethods::select("SELECT AVG(concentracao) FROM DADOS WHERE MONTH(data_hora) = ". date('m'));
$json = array();
$json["data"] = array();
if ($data != null) {
    $json["data"] = ['media-mes' => $data[0][0]];
} else {
    $json["data"] = ['erro' => 'Não foi possível acessar o banco de dados'];
    http_response_code(500);
}
header_remove();
header('Content-Type: application/json');
echo json_encode($json);
