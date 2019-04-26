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
        }
    }
?>