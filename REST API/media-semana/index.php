<?php
    //https://www.youtube.com/watch?v=7s5_TmBqZR8
        require_once "../Conexao.php";
        if (isset($_GET["req"])) {
            
            define('DB_HOST'        , "localhost");
            define('DB_USER'        , "sa");
            define('DB_PASSWORD'    , "12345");
            define('DB_NAME'        , "BANCO");
            define('DB_DRIVER'      , "sqlsrv");

            if ($_GET["req"] == "s") {
                $Conexao = Conexao::getConnection();
                $query = $Conexao->query("SELECT * FROM DADOS");
                $data   = $query->fetchAll();
                $json = [];
                
                if ($data != null) {
                    for ($i = 0; $i < sizeof($data); $i++) {
                        $json[] = [ strval($data[$i][0]) => $data[$i][1] ];
                    }
                }
                header_remove();
                header('Content-Type: application/json');
                echo json_encode($json);
            }
            else if ($_GET["req"] == "u") {
                echo 'update';
            }
        }
    
    ?>