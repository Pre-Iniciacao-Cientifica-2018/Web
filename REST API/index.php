<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <link rel="stylesheet" href="css/fonts.css">
    <script src="js/patternGraph.js"></script>
    <script src="js/resizeElements.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script>
    window.onload = eraseSessionVariables;                   
   function eraseSessionVariables(){
        $.ajax({ url: 'atualizar.php',
        data: {action: 'del'},
        type: 'post',
        success: function() {
        resizeElements();       
        }
    });
}
    </script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
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
<div class="chart-container">
<canvas id="myChart"></canvas>
<script>
 Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontFamily = "Montserrat-Medium";
var initialData = null;
var myChart = null;
var mes = false,semana = false;
myChart = createGraph(true);
var ctx = document.getElementById("myChart");

function addData(chart, label, data,canSplice) {
    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    if(canSplice){
    chart.data.labels.splice(0, 1);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.splice(0, 1);
    });
    }
    chart.update();
}
var contador = 0;
setInterval(function(){ 
    $.ajax({ 
        url: 'atualizar.php',
        data: {action: 'att'},
        type: 'post',
        success: function(output) {
            if (output != "error") {               
                var date = new Date();
                if(String(date.getMinutes()).length<2 && String(date.getHours()).length<2){
                    var time = "0"+date.getHours()+":0"+date.getMinutes();
                }
                else if (String(date.getHours()).length<2) {
                    var time = "0"+date.getHours()+":"+date.getMinutes();
                }
                else if (String(date.getMinutes()).length<2) {
                    var time = date.getHours()+":0"+date.getMinutes();
                }
                else {
                    var time = date.getHours()+":"+date.getMinutes();
                }
                contador = 0;
                myChart.data.datasets.forEach((dataset) => {
                    contador++;
                });
                var canSplice;
                if(contador<6){
                    canSplice = false;
                }
                else{
                    canSplice = true;
                }
                addData(myChart, time, JSON.parse(output)[0][0],canSplice);
            }
        }
    });
}
, 5000);

$( document ).ready(function() {
    $("[style='text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;']").remove();
});
    
</script>
</div>
</body>
</html>
