<?php

include '../SQLMethods.php';
require_once "../Carbon/autoload.php";
use Carbon\Carbon;
use Carbon\CarbonInterval;

$date = Carbon::parse(date('Y-m-d'));
$monday = $date->startOfWeek()->format('Y-m-d'); // monday
$sunday = $date->endOfWeek()->format('Y-m-d');  // sunday

$max_dia = SQLMethods::select("SELECT MAX(concentracao) FROM DADOS WHERE day(data_hora) = day(NOW())");
$min_dia = SQLMethods::select("SELECT MIN(concentracao) FROM DADOS WHERE day(data_hora) = day(NOW())");
$max_mes = SQLMethods::select("SELECT MAX(concentracao) FROM DADOS WHERE MONTH(data_hora) = MONTH(NOW())");
$min_mes = SQLMethods::select("SELECT MIN(concentracao) FROM DADOS WHERE MONTH(data_hora) = MONTH(NOW())");
$media_mes = SQLMethods::select("SELECT AVG(concentracao) FROM DADOS WHERE MONTH(data_hora) = MONTH(NOW())"); 
$max_semana = SQLMethods::select("SELECT MAX(concentracao) FROM DADOS WHERE DATE(data_hora) BETWEEN '{$monday}' AND '{$sunday}'");
$min_semana = SQLMethods::select("SELECT MIN(concentracao) FROM DADOS WHERE DATE(data_hora) BETWEEN '{$monday}' AND '{$sunday}'");
$media_semana = SQLMethods::select("SELECT AVG(concentracao) FROM DADOS WHERE DATE(data_hora) BETWEEN '{$monday}' AND '{$sunday}'");

$json = array();
$json["data"] = array();
if ($max_dia != null && $min_dia != null && $max_mes != null && $min_mes != null && $media_mes != null && $max_semana != null && $min_semana != null && $media_semana != null) {
    $json["data"] = ["0c" => $max_dia[0][0],
                     "1c" => $min_dia[0][0],
                     "2c" => $max_mes[0][0],
                     "3c" => $min_mes[0][0],
                     "4c" => $media_mes[0][0],
                     "5c" => $max_semana[0][0],
                     "6c" => $min_semana[0][0],
                     "7c" => $media_semana[0][0],
                    ];
} else {
    $json["data"] = ['erro' => 'Algo deu errado :/'];
    http_response_code(500);
}

header_remove();
header('Content-Type: application/json');
echo json_encode($json);