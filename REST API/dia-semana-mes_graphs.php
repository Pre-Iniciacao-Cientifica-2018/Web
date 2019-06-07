<?php
session_start();
$_SESSION['datepickerMensal'] = true;
$_SESSION['datepickerSemanal'] = true;
date_default_timezone_set('America/Sao_Paulo');
$_SESSION['datepicker'] = date("d/m/Y");

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/baby.css">
    <script src="js/patternGraph.js"></script>
    <script src="js/resizeElements.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
        </script>
    <style>
        body {
            height: 100vh;
            background:rgb(135, 188, 213);
        }
        #myChart {
            width: 80vw;
            height: auto;
        }
    </style>
</head>
<body onresize = "resizeElements()" onload="resizeElements()">

<div class="chart-container" style="position: relative; height:100%; width:95%;display:flex; flex-direction:column;">
<p class = "titleGraphArea">Gráfico das concentrações horárias de hoje</p>
<canvas id="myChart"></canvas>
<p class = "titleGraphArea">Gráfico das concentrações diárias dessa semana</p>

</div>

<script>
function attributeToGraph(output){
    try{
    tf = true;
            var values = new Array();
            values = JSON.parse(output);
            var graph = createGraph(false);
if(tf){
        var i;
    for(i=0;true;i++){
        if(values[i]=="end-con"){
            break;
        }
        graph.data.datasets.forEach((dataset) => {
        dataset.data.push(values[i]);
    });
    }
    ++i;   
    for(var j=i;j<Object.keys(values).length;j++){
        graph.data.labels.push(values[j]);
    }
    graph.update();
    }
}catch(e){console.log(e);}
}
var mes = false,semana = false;
var tf = false;
        $.ajax({ url: 'atualizar.php',
        data: {action: 'md'},
        type: 'post',
        success: function(output) {
            attributeToGraph(output);
    $.ajax({ url: 'atualizar.php',
        data: {action: 'dia'},
        type: 'post',
        success:function(){
            semana = true;
            $.ajax({ url: 'atualizar.php',
        data: {action: 'md'},
        type: 'post',
        success: function(output) {
            attributeToGraph(output);
            $.ajax({ url: 'atualizar.php',
        data: {action: 'sem'},
        type: 'post',
        success:function(){
            mes = true;
            $.ajax({ url: 'atualizar.php',
        data: {action: 'md'},
        type: 'post',
        success: function(output) {
            attributeToGraph(output);
        }
    });
        }
    });
        }
    });
        }        
    });
}
        });


$( document ).ready(function() {
    $("[style='text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;']").remove();
});
    
</script>
</body>
</html>
