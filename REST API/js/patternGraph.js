function createGraph(isRealTimeGraph){
    Chart.defaults.global.elements.point.radius = 20;
    Chart.defaults.global.elements.point.hitRadius = 20;

    Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontFamily = "Montserrat-Medium";
var ctx;
            if(mes){
                ctx = document.getElementById("myChart-mes");
                mes = false;
            }
            else if(semana){
                ctx = document.getElementById("myChart-semana");
                semana = false;
            }
            
         ctx = document.getElementById("myChart");
    myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: 'CO2 em ppm',
            backgroundColor: [
               'rgba(28,153,220,0.7)'
            ],
            borderColor: [
                '#ffffff'
            ],
            borderWidth: 1,

        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true,
                },
            }]

        },
        responsive: true
    }
});
if(isRealTimeGraph){
    $.ajax({ 
        url: 'atualizar.php',
        data: {action: 'initial'},
        type: 'post',
        success: function(output){
        var values = new Array();
        values = JSON.parse(output);
        for(var i=5;i>=0;i--){
            myChart.data.datasets.forEach((dataset) => {
            dataset.data.push(values[i].concentracao);
        });
        }
        for(var i=5;i>=0;i--){
            myChart.data.labels.push(values[i][2]);
        }
        myChart.update();                        
    }
});
}
return myChart;
}
