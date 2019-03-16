<?php
    require_once "Conexao.php";
    require_once "SQLMethods.php";
    session_start();    
    
    function getData($query, $first) {
        
        try {
            if ($first) {
                SQLMethods::defineCredentials();
                $resul = SQLMethods::select($query);
                $_SESSION['id'] = intval($resul[0]['id']);
                echo json_encode($resul);
            } else {
                SQLMethods::defineCredentials();
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
                getData("SELECT TOP 6 concentracao, id, FORMAT(data_hora,'hh:mm') FROM DADOS ORDER BY id DESC", true);
                break;
        }
    }
?>