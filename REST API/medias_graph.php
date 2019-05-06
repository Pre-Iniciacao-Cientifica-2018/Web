
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medias Diarias</title>
    <link rel="stylesheet" href="css/fonts.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <script src = "js/patternGraph.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/baby.css">
    <script src = "js/resizeElements.js"></script>

<style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background:rgb(135, 188, 213);
        }
    </style>
</head>
<script>
    var tf = false;
        $.ajax({ url: 'atualizar.php',
        data: {action: 'md'},
        type: 'post',
        success: function(output) {
            try{
            tf = true;
            var values = new Array();
            values = JSON.parse(output);
            if(Object.keys(values).length!=3){
           var myChart = createGraph(false);
if(tf){
    var media = 0;
        var i;
    for(i=0;true;i++){
        if(values[i]=="end-con"){
            break;
        }
        myChart.data.datasets.forEach((dataset) => {
        dataset.data.push(values[i]);
    });
    media = media + parseFloat(values[i]);
    }
    media = media/i;
    ++i;
    
    for(var j=i;j<Object.keys(values).length;j++){
        myChart.data.labels.push(values[j]);
    }
    myChart.update();
    document.getElementById("subTitle2").innerHTML = "A média de concentração de CO2 dentro desse período foi de: "+media.toFixed(2);
    document.getElementById("nograph").style.visibility = "hidden";
    }
            }
            else{
                //fiz ele mostrar um texto quando tiver 1 valor somente
                document.getElementById("nograph").innerHTML = "Foi encontrada apenas uma média dentro deste período: "+parseFloat(values[0]).toFixed(2)+", no horário/na data "+values[2];
                document.getElementById("error_img").src="img/error-icon.png";
                document.getElementById("subTitle2").style.visibility = "hidden";
            }
        }
        catch(e){
            document.getElementById("error_img").src="img/error-icon.png";
            document.getElementById("nograph").innerHTML = "Não foi encontrado nenhum dado dentro do período especificado";
            document.getElementById("subTitle2").style.visibility = "hidden";
        }
    }    
    });
    
</script>
<body onresize = "resizeElements()" onload="resizeElements()">
<div class="chart-container" style="position: relative; height:100%; width:98%;display:flex; flex-direction:column;">
<canvas id="myChart"></canvas>
<p style="margin:0 auto" id="subTitle2" class="titleFontPattern"></p> 
</div>
<p class="titleFontPattern" style="margin:0 auto;position:absolute" id="nograph"></p> 
<img id="error_img" style="margin:0 auto;width:30%;position:absolute;background-color:rgb(135, 188, 213);z-index:-1" class="Title3"> 
</body>
</html>