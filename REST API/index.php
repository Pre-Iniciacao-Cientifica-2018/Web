<?php include 'atualizar.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="chart-container">
<canvas id="myChart" width="1000" height="500"></canvas>
<script>

var initialData = null;
var myChart = null;

function setData(output) {
    initialData = JSON.parse(output);
    myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [initialData[5][2],initialData[4][2],initialData[3][2],initialData[2][2],initialData[1][2],initialData[0][2]],
        datasets: [{
            label: 'CO2 em ppm',
            lineTension: 0,
            data: [initialData[5].concentracao,initialData[4].concentracao,initialData[3].concentracao,initialData[2].concentracao,initialData[1].concentracao,initialData[0].concentracao],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
} 

$.ajax({ 
    url: 'atualizar.php',
    data: {action: 'initial'},
    type: 'post',
    success: setData
});

var ctx = document.getElementById("myChart");


function addData(chart, label, data) {
    chart.data.labels.push(label);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.push(data);
    });
    chart.update();
    chart.data.labels.splice(0, 1);
    chart.data.datasets.forEach((dataset) => {
        dataset.data.splice(0, 1);
    });
    chart.update();
}

setInterval(function(){ 
    $.ajax({ 
        url: 'atualizar.php',
        data: {action: 'att'},
        type: 'post',
        success: function(output) {
            if (output != "error") {
                var date = new Date();
                var time = date.getHours()+":"+date.getMinutes();
                addData(myChart, time, JSON.parse(output)[0].concentracao);
            }
        }
    });
}
, 5000);
</script>
</div>
</body>
</html>