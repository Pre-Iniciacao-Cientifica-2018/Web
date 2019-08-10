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
            background:#f4f8ff;
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
<canvas id="myChart-semana"></canvas>
<p class = "titleGraphArea">Gráfico das concentrações diárias desse mês</p>
<canvas id="myChart-mes"></canvas>
</div>

<script>
var contador = 0;
var graphs = new Array();
function attributeToGraph(output){
    try{
            var values = new Array();
            values = JSON.parse(output);
             graphs[contador] = createGraph(false);
    if(values!=null){
        var i;
    for(i=0;true;i++){
        if(values[i]=="end-con"){
            break;
        }
        graphs[contador].data.datasets.forEach((dataset) => {
        dataset.data.push(parseFloat(values[i]).toFixed(2));
    });
    }
    ++i;   
    for(var j=i;j<Object.keys(values).length;j++){
        graphs[contador].data.labels.push(values[j]);
    }
    graphs[contador].update();
}
contador++;
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
            for(var i=0;i<3;i++){
    contador = 0;
    graphs[i].data.datasets[0].data.forEach((dataset) => {
        contador++;
    });
    if(contador==0){
        var context = graphs[contador].chart.ctx;
      var width = graphs[contador].chart.width;
      var height = graphs[contador].chart.height;
      graphs[contador].clear();      
      context.save();
      context.textAlign = 'center';
      context.textBaseline = 'middle';
      context.font = "2.5vw 'Title'";
      context.fillText('Dados inexistentes!', width / 2, height / 2);
      context.restore();
    }
}
            $.ajax({ url: 'atualizar.php',
        data: {action: 'del'},
        type: 'post'
    });
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
