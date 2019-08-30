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

<!DOCTYPE HTML>

<html>
	<head>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>   
	  
		<title>ConCO2 - Concentração de Gás Carbônico</title>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  
		<link rel="icon" href="grafico.png">
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="css/css.css">
		<link rel="stylesheet" type="text/css" href="css/fonts.css">
		<link rel="stylesheet" href="css/datepicker.css">
		<meta charset="UTF-8">
		<link href='https://fonts.googleapis.com/css?family=Roboto:500,900,100,300,700,400'>	
		<script src="js/patternGraph.js"></script>
	<script src="js/resizeElements.js"></script>
    <script src="js/Chart.min.js"></script>
 
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
		$.ajax({ url: 'all_analise/index.php',
        type: 'post',
        success: function(output) {
			var analise = new Array();
			 analise = JSON.parse(output);
			document.getElementById("maiorDia").innerHTML = parseFloat(analise["data"].czero).toFixed(2) + " ppm";
				
			document.getElementById("menorDia").innerHTML = parseFloat(analise["data"].cone).toFixed(2) + " ppm";
				
			document.getElementById("maiorSemana").innerHTML = parseFloat(analise["data"].cfive).toFixed(2) + " ppm";
				
			document.getElementById("menorSemana").innerHTML = parseFloat(analise["data"].csix).toFixed(2) + " ppm";
				
			document.getElementById("maiorMes").innerHTML = parseFloat(analise["data"].ctwo).toFixed(2) + " ppm";
				
			document.getElementById("menorMes").innerHTML = parseFloat(analise["data"].cthree).toFixed(2) + " ppm";
				
			document.getElementById("mediaSemana").innerHTML = parseFloat(analise["data"].cseven).toFixed(2) + " ppm";
				
			document.getElementById("mediaMes").innerHTML = parseFloat(analise["data"].cfour).toFixed(2) + " ppm";
			//transformar em um FOR
		}}); 
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
		<script>
			$(document).ready(function() {

			$('.lisobre').click(function() {
			$('html, body').animate({
			scrollTop: $('#sobre').offset().top
			}, 2000);
			});
			
			$('.lianalise').click(function() {
			$('html, body').animate({
			scrollTop: $('#analise').offset().top
			}, 2000);
			});
			
			$('.ligraficos').click(function() {
			$('html, body').animate({
			scrollTop: $('#grafico').offset().top
			}, 2000);
			});
			
			$('.limedicao').click(function() {
			$('html, body').animate({
			scrollTop: $('#medicao').offset().top
			}, 2000);
			});


			$('.liebook').click(function() {
			$('html, body').animate({
			scrollTop: $('#ebook').offset().top
			}, 2000);
			});
			
			$('.lico2').click(function() {
			$('html, body').animate({
			scrollTop: $('#sobreco2').offset().top
			}, 2000);
			});
			
			$('.lihome').click(function() {
			$('html, body').animate({
			scrollTop: $('#intro').offset().top
			}, 2000);
			});
			
			});
		</script>
	</head>
	<body onresize = "resizeElements()" onload="resizeElements()">
		<nav>
			<div class="logoMenu">
				<img src="img/logoMenu.png" class="imgLogoMenu" alt="Conco2">
			</div>
		
			<ul id="menu">
				<li class="lisobre"><a href="#">Sobre</a></li>
				<li class="lianalise"><a href="#">Análise</a></li>
				<li class="ligraficos"><a href="#">Gráficos</a></li>
				<li class="limedicao"><a href="#">Medição</a></li>
				<li class="liebook"><a href="#">Ebook</a></li>
				<li class="lico2"><a href="#">O Gás Carbônico</a></li>
				<li class="lihome"><a href="#">Início</a></li>
			</ul>
		</nav>
		
		<section id="intro">
			<div class="esquerda">
				<img src="img/grafico.png" class="grafInicio" alt="">
			</div>
			
			<div class="direita">
				<img src="img/textLogo.png" class="textoLogo" alt="">
				<p class="pIntro">Concentração de CO<sub>2</sub> na atmosfera com gráficos em tempo real.</p>
				<button name="btnDownload" class="download">DOWNLOAD DO APP</button>
				<div class="creditos">
					<p>Um projeto desenvolvido por:</p>
					<img src="img/logoUsp.png" class="imgCredito" alt="">
					<img src="img/logoEtesp.png" class="imgCredito" alt="">
				</div>
			</div>
		</section>
		
		<section id="sobreco2">
			<div class="divTextoSobre">
				<h1>O GÁS CARBÔNICO</h1>
				<p>O carbono é um elemento básico na composição dos organismos, tornando-o indispensável para a vida no planeta. Este elemento é estocado na atmosfera, nos oceanos, solos rochas sedimentares e está presente nos combustíveis fósseis. Contudo, o carbono não fica fixo em nenhum desses estoques. Existe uma série de interações por meio das quais ocorre a transferência de carbono de um estoque para outro. Muitos organismos nos ecossistemas terrestres e nos oceanos, como as plantas, absorvem o carbono encontrado na atmosfera na forma de dióxido de carbono (CO<sub>2</sub>). Esta absorção se dá através do processo de fotossíntese. Por outro lado, os vários organismos, tanto plantas como animais, libertam dióxido de carbono para a atmosfera mediante o processo de respiração. Existe ainda o intercâmbio de dióxido de carbono entre os oceanos e a atmosfera por meio da difusão.</p>
			</div>
			<div class="divImgSobre">
				<img src="img/sobre.png" class="imgSobre" alt=""> 
			</div>
		</section>
		
		<section id="ebook">
			<img src="img/trans1.png" class="transicao">
			<div class="divImgEbook">
				<img src="img/teste.png" class="imgEbook" alt="">
			</div>
			<div class="divTextoEbook">
				<h1>EBOOK</h1>
				<p class="tituloebook">O carbono é um elemento básico na composição dos organismos, tornando-o indispensável para a vida no planeta. Este elemento é estocado na atmosfera, nos oceanos, solos rochas sedimentares e está presente nos combustíveis fósseis. Contudo, o carbono não fica fixo em nenhum desses estoques. Existe uma série de interações por meio das quais ocorre a transferência de carbono de um estoque para outro. Muitos organismos nos ecossistemas terrestres e nos oceanos, como as plantas, absorvem o carbono encontrado na atmosfera na forma de dióxido de carbono (CO<sub>2</sub>). </p>
				<button name="btnDownload" class="btnEbook">LEIA ONLINE</button>
				<button name="btnDownload" class="btnEbook">DOWNLOAD DO EBOOK</button>
			</div>
		</section>
		
		<section id="medicao">
			<img src="img/trans2.png" class="transicao">
			<div class="medEsquerda">
				<h1>COMO É FEITA A MEDIÇÃO?</h1>
				<p class="pMed1">Um sensor de dióxido de carbono serve para medir a sua quantidade na forma gasosa ou líquida. Esses sensores são muito utilizados em diversos campos científicos e indústrias como instrumento de estudo ou produto, como por exemplo ar condicionados que medem a qualidade do ar e usam a quantidade de gás carbônico como parâmetro ou até mesmo determinam a quantidade de pessoas em um ambiente devida a quantidade desse gás na habitação. </p>
				<p>O aparelho tem três componentes principais: a fonte de luz, uma ferramenta que recebe a luz emitida e um detector. Durante a medição, a quantidade de luz que chega no lado rebecebimento varia de acordo com a concentração de gás carbônico presente no sensor, ou seja, quanto mais CO<sub>2</sub> dentro no ambiente, menos luz será recebida para a medição. O resultado então é obtido em ppm que é a concentração de partículas por milhão.</p>
				<p class="pMedOculto">Para visualizar o gráfico e os dados de medição, acesse o site por um computador ou baixe nosso aplicativo!</p>
			</div>
			
			<div class="medDireita" class="transicao">
				<p>ESQUEMA DE FUNCIONAMENTO</p>
				<img src="img/funcionamento.png" class="imgFuncionamento">
			</div>
						
		</section>
		
		<section id="grafico" style="margin:0 auto">
			<img src="img/trans3.png" class="transicao">
			<h1>GRÁFICO EM TEMPO REAL DA CONCENTRAÇÃO DE CO<sub>2</sub> NA ATMOSFERA</h1>
			<div class="chart-container" style="position: relative; height:100%; width:95%;display:flex; flex-direction:column;margin:0 auto">
<canvas id="myChart"></canvas>
<script>
 Chart.defaults.global.defaultFontColor = 'white';
Chart.defaults.global.defaultFontFamily = "Montserrat-Medium";
var initialData = null;
var myChart = null;
var mes = false,semana = false;medmes=false;ano=false;
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
                dado = JSON.parse(output);
                contador = 0;
                myChart.data.datasets[0].data.forEach((dataset) => {
                    contador++;
                });
                var canSplice;
                if(contador<6){
                    canSplice = false;
                }
                else{
                    canSplice = true;
                }
                addData(myChart, dado[0][2], dado[0][0],canSplice);
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
<form action="dia-semana-mes_graphs.php">		
<button class="btnOpenGraphs">Veja todos os gráficos com concentrações diárias, horárias, dentre outras!</button>
</form>
			<form method = "post" class="formsDatepickerCo2">
				<h1 style="font-size:1.5em;margin-top:30px">Escolha uma das datas para que seja mostrado suas médias horárias:</h1>
				<input style="margin-left:3%" type="text" name = "datepicker" class="datepicker">
					<input type="submit" value="Vamos lá!" id="getMediasHorarias"> 
				</form>
				<form method = "post" class="formsDatepickerCo2">
				<h1 style="font-size:1.5em;margin-top:30px">Escolha duas datas para que seja mostrado as médias diárias dentro do período escolhido</h1>
				<input type="text" name = "datepickerFrom" class="datepicker" placeholder="De:">
				<input type="text" name = "datepickerTo" class="datepicker" placeholder="Até:">
					<input type="submit" value="Vamos lá!" text="Exibir gráfico" id="getMediasDiarias"> 
				</form>
				
		</section>
		
		<section id="analise">
			<img src="img/trans4.png" class="transicao">
			
			<h1>ANÁLISE DA CONCENTRAÇÃO DE CO<sub>2</sub></h1>
			
			<div class="divAnaliseCateg1">
				<p>Maior concentração </p><p> do dia</p>
			</div>
			<div class="divAnaliseCateg1">
				<p>Menor concentração </p><p> do dia</p>
			</div>
			<div class="divAnaliseCateg1">
				<p>Maior concentração </p><p> da semana</p>
			</div>
			<div class="divAnaliseCateg1">
				<p>Menor concentração </p><p> da semana</p>
			</div>
			
			<div class="divAnalise1">
				<p id = "maiorDia">999.99 ppm </p>
			</div>
			<div class="divAnalise1">
				<p id = "menorDia">999.99 ppm </p>
			</div>
			<div class="divAnalise1">
				<p id = "maiorSemana">999.99 ppm </p>
			</div>
			<div class="divAnalise1">
				<p id = "menorSemana">999.99 ppm </p>
			</div>
			
			<div class="divAnaliseCateg2">
				<p>Maior concentração </p><p> do mês</p>
			</div>
			<div class="divAnaliseCateg2">
				<p>Menor concentração </p><p> do mês</p>
			</div>
			<div class="divAnaliseCateg2">
				<p>Média da </p><p> semana</p>
			</div>
			<div class="divAnaliseCateg2">
				<p>Média do </p><p> mês</p>
			</div>
			
			<div class="divAnalise2">
				<p id = "maiorMes">999.99 ppm </p>
			</div>
			<div class="divAnalise2">
				<p id = "menorMes">999.99 ppm </p>
			</div>
			<div class="divAnalise2">
				<p id = "mediaSemana">999.99 ppm </p>
			</div>
			<div class="divAnalise2">
				<p id = "mediaMes">999.99 ppm </p>
			</div>
			
			<p class="pParametro">Valores de referência, segundo a CETESB - baixo: abaixo de 999 ppm;   médio: entre 999 ppm e 999 ppm;  alto: acima de 999 ppm. </p>
			<P class="pParametro">Para mais dados de análise, baixe o nosso aplicativo!</p>
		</section>
		
		<section id="sobre">
			<img src="img/trans1.png" class="transicao">
			<h1>SOBRE NÓS</h1>
			<div class="textosSobre" id="sobre1">
				<p>O projeto ConCO<sub>2</sub> é resultado de um trabalho de pré-inciação-científica idealizado pelo professor Bernardo Luis Rodrigues de Andrade, da POLI-USP, desenvolvido por alunos da Escola Técnica Estadual de São Paulo (ETESP), sob a orientação dos professores......., tendo sido iniciado em setembro de 2018 e desenvolvido ao longo de 1 ano. O principal objetivo do projeto é facilitar o acesso a dados e informações sobre a emissão de gases de efeito estufa, principalmente o CO<sub>2</sub>, para a população geral. Para isso foi desenvolvido um site, um e-book e uma estação de medição de CO<sub>2</sub>, colocada na Raia Olímpica da USP (Cidade Universitária) na Marginal Pinheiros.</p><br>
				<p class="subtituloSobre">Por que na Marginal Pinheiros? </p>
				<p>O equipamento é colocado na Marginal Pinheiros por dois principais fatores, entre eles estão:</p>
				<p>- A facilidade para manutenção, realizada pela USP;</p>
				<p>- Uma amostragem diversificada e representativa.</p><br>
			</div>
			<div class="textosSobre" id="sobre2">
				
				<p class="subtituloSobre">Qual a importância de se medir os níveis de CO<sub>2</sub>?</p>
				<p>- Monitoramento do comportamento dos gases na atmosfera;</p>
				<p>- Obtenção de dados quantitativos para a análise de qualidade de ar em determinado período de tempo;</p>
				<p>- Prevenção de doenças causadas pela alta concentração de gases.</p> <br>
				
				<p class="subtituloSobre">Possui mais alguma dúvida? Nos escreva sobre:</p>
				
			</div>
			<div class="textosSobre" id="sobre3"> 
				<p class="subtituloSobre">Lista de alunos participantes:</p>
				<p>Bianca Tiemi Kuraoka Uemura</p>
				<p>Brendon Angelo</p>
				<p>Camilla Rosa Freire Sousa</p>
				<p>Ederson Gonzaga</p>
				<p>Gabriel Almeida</p>
				<p>Gabriel Braga Lagrotaria</p>
				<p>Gabriel Gomes Gameiro</p>
				<p>Gustavo Palma</p>
				<p>Henry Silva Castelli</p>
				<p>Letícia Mendes</p>
				<p>Lucas Costa Mignoli Ferreira da Silva</p>
				<p>Mariana Toyshima Candermo</p>
				<p>Matheus Henrique Maello</p>
				<p>Paula Tamai</p>
				<p>Pedro Buczinski</p>
				<p>Romário Gomes de Souza</p>
				<p>Stéfano Kenji</p>

			</div>
		</section>
		
		<footer>
			<img src="img/logoUspEtesp.png" class="imgUspEtesp" alt=" Poli Usp Etesp">
		</footer>
	</body>
</html>
