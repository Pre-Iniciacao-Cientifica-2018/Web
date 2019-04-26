<?php
include "../SQLMethods.php";
require_once "../Carbon/autoload.php";
use Carbon\Carbon;
use Carbon\CarbonInterval;

$date = Carbon::parse(date('Y-m-d'));
$monday = $date->startOfWeek()->format('Y-m-d'); // monday
$sunday = $date->endOfWeek()->format('Y-m-d');  // sunday

$data = SQLMethods::select("SELECT MAX(concentracao) FROM DADOS WHERE DATE(data_hora) BETWEEN '{$monday}' AND '{$sunday}'");
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