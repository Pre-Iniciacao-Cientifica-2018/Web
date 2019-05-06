<?php
    
    include realpath(__DIR__).'/SQLMethods.php';
    
    session_start();    
    
    function getData($query, $first) {
        
        try {
            if ($first) {
                $resul = SQLMethods::select($query);
                $_SESSION['id'] = intval($resul[0][1]);
                echo json_encode($resul);
            } else {
                $resul = SQLMethods::select($query);
                if (!empty($resul)) {
                    $_SESSION['id'] += 1;
                    echo json_encode($resul);
                } else { echo 'error'; }
            }
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    function eraseSessionVariables(){
        session_destroy();
    }

    function getMedias(){
        $return;
        if (isset($_SESSION["datepicker"]) && !empty($_SESSION["datepicker"])) {
            convertToArray($return,"SELECT avg(concentracao),DATE_FORMAT(data_hora,'%H') TIMEONLY FROM `dados` WHERE date_format(date(data_hora),'%d/%m/%Y') like '". $_SESSION['datepicker']."' GROUP BY hour(data_hora) ORDER BY HOUR(data_hora)");        
        }
        else if(isset($_SESSION["datepickerFrom"]) && !empty($_SESSION["datepickerFrom"])){
            $_SESSION['datepickerFrom'] = substr($_SESSION['datepickerFrom'],6)."-".$_SESSION['datepickerFrom'][3].$_SESSION['datepickerFrom'][4]."-".substr($_SESSION['datepickerFrom'],0,2);
            $_SESSION['datepickerTo'] = substr($_SESSION['datepickerTo'],6)."-".$_SESSION['datepickerTo'][3].$_SESSION['datepickerTo'][4]."-".substr($_SESSION['datepickerTo'],0,2);
            convertToArray($return,"SELECT avg(concentracao),DATE_FORMAT(date(data_hora),'%d/%m/%Y') from dados where date(data_hora) BETWEEN '".$_SESSION['datepickerFrom']."' and '".$_SESSION['datepickerTo']."' group by day(data_hora),month(data_hora),year(data_hora) order by data_hora");        
        }
        else if(isset($_SESSION["datepickerSemanal"]) && !empty($_SESSION["datepickerSemanal"])){
            convertToArray($return,"SELECT avg(concentracao),date_format(date(data_hora),'%d/%m/%Y') from dados where week(data_hora) = week(now()) and month(data_hora) = month(now()) and year(data_hora) = year(now()) group by day(data_hora),month(data_hora),year(data_hora) order by data_hora");
        }
        else if(isset($_SESSION["datepickerMensal"]) && !empty($_SESSION["datepickerMensal"])){
            convertToArray($return,"SELECT avg(concentracao),date_format(date(data_hora),'%d/%m/%Y') from dados where month(data_hora) = month(now()) and year(data_hora) = year(now()) group by day(data_hora),month(data_hora),year(data_hora) order by data_hora");
        }
        if(isset($_SESSION["datepicker1"]) && !empty($_SESSION["datepicker1"])){
            convertToArray($return,"SELECT concentracao,datepart(hour,data_registro) from MEDIAS_HORARIAS WHERE convert(varchar(10),data_registro,103) = '".$_SESSION["datepicker1"]."' ORDER by datepart(hour,data_registro)");
            $return[count($return)] = "start-con";
            convertToArray($return,"SELECT concentracao,datepart(hour,data_registro) from MEDIAS_HORARIAS WHERE convert(varchar(10),data_registro,103) = '".$_SESSION["datepicker2"]."' ORDER by datepart(hour,data_registro)");
        }
        echo json_encode($return);
}
    function convertToArray(&$return,$stringQuery){
        $dados_media = SQLMethods::select($stringQuery);
        try{
            for($i=0;$i<count($dados_media);$i++){
                $return[$i] = $dados_media[$i][0];
            }
        }catch(Exception $e){}
            try{
            $return[count($return)] = "end-con";
            for($i=0;$i<count($dados_media);$i++){
                if(isset($_SESSION["datepicker"])){
                    $return[count($return)] = $dados_media[$i][1].":00-".$dados_media[$i][1].":59";
                }
                else{
                    $return[count($return)] = $dados_media[$i][1];
                }
                
            }
        }
            catch(Exception $e){}
            //o javascript não tem matriz, por isso retornei array 
    } 

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'att':
                getData("SELECT concentracao FROM DADOS WHERE id = ".($_SESSION['id'] + 1), false); 
                break;                
            case 'initial':
                $_SESSION['id'] = 0;
                getData("SELECT concentracao, id, DATE_FORMAT(data_hora,'%H:%i') as data_hora FROM DADOS ORDER BY id DESC LIMIT 6", true);
                break;
                case 'md':
                getMedias();break;
                case 'del':
                eraseSessionVariables();break;
        }
    }
?>