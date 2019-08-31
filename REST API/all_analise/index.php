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
$json["data"] = array($max_dia[0][0],$min_dia[0][0],$max_mes[0][0],$min_mes[0][0],$media_mes[0][0],$max_semana[0][0],$min_semana[0][0],$media_semana[0][0]);
header_remove();
echo json_encode($json);