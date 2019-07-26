<?php include 'atualizar.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $canChangePage  = true;
    $string = "location: medias_graph.php";
    if (isset($_POST["datepicker"]) && !empty($_POST["datepicker"])) {
        $_SESSION["datepicker"] = str_replace("-","/",$_POST["datepicker"]);
    }
    else if(isset($_POST["datepickerFrom"]) && !empty($_POST["datepickerFrom"])&&isset($_POST["datepickerTo"]) && !empty($_POST["datepickerTo"])){
        $_SESSION["datepickerFrom"] = str_replace("-","/",$_POST["datepickerFrom"]);
        $_SESSION["datepickerTo"] = str_replace("-","/",$_POST["datepickerTo"]);
    }
    else if(isset($_POST["datepickerSemanal"]) && !empty($_POST["datepickerSemanal"])){
        $_SESSION["datepickerSemanal"] = str_replace("-","/",$_POST["datepickerSemanal"]);
    }
    else if(isset($_POST["datepickerMensal"]) && !empty($_POST["datepickerMensal"])){
        $_SESSION["datepickerMensal"] = str_replace("-","/",$_POST["datepickerMensal"]);
    }
    else if(isset($_POST["datepicker1"]) && !empty($_POST["datepicker1"])){
        $_SESSION["datepicker1"] = str_replace("-","/",$_POST["datepicker1"]);
        $string = "location: compare_graphs.php";
    }   
    else{$canChangePage = false;}
    if($canChangePage){
    header($string);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de gráfico</title>
    <script src="js/Chart.min.js"></script>
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css\baby.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <script type="text/javascript" src="js/patternGraph.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
  <script src = "js/resizeElements.js"></script>

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
      $( function() {
    $( ".datepicker" ).datepicker({
      showButtonPanel: true,
      changeMonth: true,
      changeYear: true,
      dateFormat: "dd/mm/yy",
      dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        currentText: 'Hoje',
        closeText : 'Fechar'

    });
    } );   
    </script>

</head>
<div>
<body onresize = "resizeElements()">
<h1 class = "titleFontPattern" id="mainTitle" style="width:70%"> Área dos gráficos </h1>
<div id = "content-divs">
<h1 id = "subTitle1" class = "titleFontPattern"  class="subTitle">Ficou curioso para saber as concentrações de CO2 de outros dias?</h1>
<p class="text" style="margin-bottom:2vw;margin-top:2vw;">Para uma melhor visualização das concentrações de CO2 para você, deixamos um espaço destinado para que possas ver as médias diárias/semanais/mensais/horárias ou até dentro de um período específico escolhido ao seu gosto. Divirta-se! </p>
<form method = "post" >
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Escolha uma das datas para que seja mostrado suas médias horárias:</h1>
<input type="text" name = "datepicker" class="datepicker">
    <input type="submit" text="Exibir gráfico" id="getMediasHorarias"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Escolha duas datas para que seja mostrado as médias diárias dentro do período escolhido</h1>
<input type="text" name = "datepickerFrom" class="datepicker" placeholder="De:">
<input type="text" name = "datepickerTo" class="datepicker" placeholder="Até:">
    <input type="submit" text="Exibir gráfico" id="getMediasDiarias"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Clique no botão abaixo para que seja mostrado as médias desta semana</h1>
<input type="submit" text="Exibir gráfico" name = "datepickerSemanal" id="getMediaSemanal"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Clique no botão abaixo para que seja mostrado as médias deste mês</h1>
<input type="submit" text="Exibir gráfico" name = "datepickerMensal" id="getMediaMensal"> 
</form>
<form method = "post">
<h1 id = "subTitle2" class = "titleFontPattern" class="subTitle">Escolha duas datas para que seja mostrado uma comparação entre suas médias horárias de concentração de CO2 (not func)</h1>
<input type="text" name = "detepicker1" class="datepicker" placeholder="Data 1">
<input type="text" name = "detepicker2" class="datepicker" placeholder="Data 2">
    <input type="submit" text="Exibir gráfico" id="getMediasHorarias2"> 
</form>
</div>
</div>
</body>
</html>