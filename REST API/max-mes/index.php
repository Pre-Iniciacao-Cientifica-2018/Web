<?php
require_once "../Conexao.php";
require_once "../SQLMethods.php";

SQLMethods::defineCredentials();
$data = SQLMethods::select("SELECT MAX(concentracao) FROM DADOS WHERE MONTH(data_hora) = ". date(m));
$json = [];
if ($data != null) {
    $json[] = ['max-con' => $data[0][0]];
} else {
    $json[] = ['erro' => 'Não foi possível acessar o banco de dados'];
    http_response_code(500);
}
header_remove();
header('Content-Type: application/json');
echo json_encode($json);