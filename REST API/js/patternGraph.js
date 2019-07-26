function createGraph(isRealTimeGraph){
    Chart.defaults.global.elements.point.radius = 18;
    Chart.defaults.global.elements.point.hitRadius = 20;
    Chart.defaults.global.defaultFontColor = '#89d2f5';
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
       else{
            ctx = document.getElementById("myChart");
        }        

    myChart = new Chart(ctx, {
    type: 'line',
    data: {
        datasets: [{
            label: 'CO2 em ppm',
            backgroundColor: [
               'rgba(0,0,0,0)'
            ],
            borderColor: [
                '#ffffff'
            ],
            borderWidth: 3,

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
        responsive: true,
        backgroundRules: [{
            backgroundColor: '#75ab5d', 
            yAxisSegement: 475
        }, {
            backgroundColor: '#e3cb86',
            yAxisSegement: 650
        }, {
            backgroundColor: '#e7b886',
            yAxisSegement: 825
        }, {
            backgroundColor: '#c97979',
            yAxisSegement: 1000
        }, {
            backgroundColor: '#a791de',
            yAxisSegement: 20000
        }, {
            backgroundColor: '#f4f8ff',
            yAxisSegement: 20001
        }]
    },
    plugins: [{
        beforeDraw: function (chart) {
            var rules = chart.chart.options.backgroundRules;
            var ctx = chart.chart.ctx;
            var yAxis = chart.chart.scales["y-axis-0"];
            var xaxis = chart.chart.scales["x-axis-0"];
            for (var i = 0; i < rules.length; ++i) {
                var yAxisSegement = (rules[i].yAxisSegement > yAxis.ticksAsNumbers[0] ? yAxis.ticksAsNumbers[0] : rules[i].yAxisSegement);
                var yAxisPosStart = yAxis.height - ((yAxisSegement * yAxis.height) / yAxis.ticksAsNumbers[0]) + chart.chart.controller.chartArea.top;
                var yAxisPosEnd = (i === 0 ? yAxis.height : yAxis.height - ((rules[i - 1].yAxisSegement * yAxis.height) / yAxis.ticksAsNumbers[0]));
                ctx.fillStyle = rules[i].backgroundColor;
                ctx.fillRect(xaxis.left, yAxisPosStart, xaxis.width, yAxisPosEnd - yAxisPosStart + chart.chart.controller.chartArea.top);
            }
        }
    }]
});
if(isRealTimeGraph){
    $.ajax({ 
        url: 'atualizar.php',
        data: {action: 'initial'},
        type: 'post',
        success: function(output){
        var values = new Array();
        try{
        values = JSON.parse(output);
        
        }catch(e){return;}
        for(var i=5;i>=0;i--){
            try{
            var aux = values[i].concentracao;
            }catch(e){continue;}
            myChart.data.datasets.forEach((dataset) => {
            dataset.data.push(aux);
        });
    
        }
        for(var i=5;i>=0;i--){
            try{
            var aux = values[i][2];
        }catch(e){continue;}
            myChart.data.labels.push(aux);
        }
        myChart.update();                        
    }
});
}
myChart.update();     
return myChart;
}
