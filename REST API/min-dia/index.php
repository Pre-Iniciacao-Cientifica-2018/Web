<?php
require_once "../Conexao.php";
require_once "../SQLMethods.php";
require_once "../Carbon/autoload.php";
use Carbon\Carbon;
use Carbon\CarbonInterval;

$date = Carbon::parse(date('Y-m-d'));
SQLMethods::defineCredentials();

$data = SQLMethods::select("SELECT min(concentracao) FROM DADOS WHERE day(data_hora) = ". date(d));
$json = array();
$json["data"] = array();
if ($data != null) {
    $json["data"] = ['max-con' => $data[0][0]];
} else {
    $json["data"] = ['erro' => 'Não foi possível acessar o banco de dados'];
    http_response_code(500);
}
header_remove();
header('Content-Type: application/json');
echo json_encode($json);