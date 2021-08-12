<html>
<head>
<link rel="icon" type="image/png" href="https://ctd.ifsp.edu.br/templates/padraogoverno01/favicon.ico">

	<title>
  Hidrometro</title>
  <meta name="viewport" content="width=320">
<meta name="viewport" content="width=device-width">
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['line','bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

<?php  ////////////////////////// dados das ultimas 24 horas ////////////////////////
?>

  var data = google.visualization.arrayToDataTable([
          ['hora', 'entrada', 'horta'],
          <?php
include("connect.php");
$link = Connection();
$sql = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta, cast(time as date) as dia,hour(time) as hora, DATE_FORMAT(time, '%e/%M/%Y %H:%i:%s') as horaatual from hidrometro_ifsp WHERE time > date_sub(now(),interval 1 day) group by cast(time as date), hour(time);"; // 
$result = mysqli_query($link, $sql);
$tr = mysqli_num_rows($result); // verifica o número total de registros
$total=0;
$totalhorta=0;
if (mysqli_num_rows($result)) {     
    $i=0;
      while ($row = $result->fetch_assoc()) {
         
          $hora = $row["hora"];
          $soma = $row["soma"]; 
          $somahorta = $row["somahorta"]; 
          $dia = $row["dia"]; 
          $horaatual = $row["horaatual"]; 
          $total=$total+$soma;
          $totalhorta=$totalhorta+$somahorta;

          echo "[ '" . $hora . "' , " . $soma. " , " . $somahorta. "],"; 
                $i++;
              }
      $result->free();
  }
  

?>
 
        ]);

<?php  ////////////////////////// dados da ultima semana ////////////////////////
?>
 var barData = google.visualization.arrayToDataTable([
          ['dia', 'entrada', 'horta'],
          <?php

$sql2 = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta, DATE_FORMAT(time, '%W') as diasemana, hour(time) as hora from hidrometro_ifsp WHERE time > date_sub(now(),interval 7 day) group by cast(time as date), day(time);"; // 
$result2 = mysqli_query($link, $sql2);

$totalsemana=0;
$totalhortasemana=0;
if (mysqli_num_rows($result2)) {     
    $i=0;
      while ($row2 = $result2->fetch_assoc()) {
         
          $hora = $row2["hora"];
          $soma = $row2["soma"]; 
          $somahortasemana = $row2["somahorta"]; 
          $dia = $row2["dia"]; 
          $diasemana = $row2["diasemana"]; 
          $totalsemana=$totalsemana+$soma;
          $totalhortasemana=$totalhortasemana+$somahortasemana;

          echo "[ '" . $diasemana . "' , " . $soma. " , " . $somahortasemana. "],"; 
                $i++;
              }
      $result2->free();
  }
?>
        ]);

<?php  ////////////////////////// dados das ultimo mes ////////////////////////
?>
var barDataultimomes = google.visualization.arrayToDataTable([
          ['dia', 'entrada', 'horta'],
          <?php

$sql3 = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta,  DATE_FORMAT(time, '%e') as dia from hidrometro_ifsp  WHERE MONTH(time)= MONTH(CURDATE()) group by cast(time as date), day(time);"; // 
$result3 = mysqli_query($link, $sql3);

$totalmes=0;
$totalhortames=0;
if (mysqli_num_rows($result3)) {     
    $i=0;
      while ($row3 = $result3->fetch_assoc()) {
         
          $soma = $row3["soma"]; 
          $somahortames = $row3["somahorta"]; 
          $dia = $row3["dia"]; 
          $totalmes=$totalmes+$soma;
          $totalhortames=$totalhortames+$somahortames;

          echo "[ '" . $dia . "' , " . $soma. " , " . $somahortames. "],"; 
                $i++;
              }
      $result3->free();
  }
  

?>
 
        ]);

 <?php  ////////////////////////// dados das ultimo ano ////////////////////////
?>
var barDataano = google.visualization.arrayToDataTable([
          ['mes', 'entrada', 'horta'],
          <?php

$sql4 = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta,  DATE_FORMAT(time, '%M') as mes from hidrometro_ifsp  WHERE YEAR(time)= YEAR(CURDATE()) group by  YEAR(time), MONTH(time);"; // 
$result4 = mysqli_query($link, $sql4);

$totalano=0;
$totalhortaano=0;
if (mysqli_num_rows($result4)) {     
    $i=0;
      while ($row4 = $result4->fetch_assoc()) {
         
          $soma = $row4["soma"]; 
          $somahortaano = $row4["somahorta"]; 
          $mes = $row4["mes"]; 
          $totalano=$totalano+$soma;
          $totalhortaano=$totalhortaano+$somahortaano;

          echo "[ '" . $mes . "' , " . $soma. " , " . $somahortaano. "],"; 
                $i++;
              }
      $result4->free();
  }
  

?>
 
        ]);


<?php  ////////////////////////// opcoes ////////////////////////
?>
        var options = {
          chart: {
            title: 'Consumo de água por Hora',
            subtitle: 'Últimas 24 horas: Entrada: <?php echo $total; ?> litros, Horta: <?php     echo number_format($totalhorta); ?> litros. (última atualização: <?php echo $horaatual; ?> )',
            bar: {groupWidth: '95%'},
            vAxis: { gridlines: { count: 4 } }

          }
        };

        var barOptions = {
        chart: {
        title: 'Consumo de água por dia da última semana',
        subtitle: 'Últimos 7 dias: Entrada: <?php echo $totalsemana; ?> litros, Horta: <?php     echo number_format($totalhortasemana); ?> litros. (última atualização: <?php echo $horaatual; ?> )',
        },
        width: 900,
        height: 500
    };

    var barOptionsultimomes = {
        chart: {
        title: 'Consumo de água por dia do mês atual',
        subtitle: 'Consumo do mês: Entrada: <?php echo $totalmes; ?> litros, Horta: <?php     echo number_format($totalhortames); ?> litros. (última atualização: <?php echo $horaatual; ?> )',
        },
        width: 900,
        height: 500
    };

    var barOptionano = {
        chart: {
        title: 'Consumo de água por mês do ano atual',
        subtitle: 'Consumo do ano: Entrada: <?php echo $totalano; ?> litros, Horta: <?php     echo number_format($totalhortaano); ?> litros. (última atualização: <?php echo $horaatual; ?> )',
        },
        width: 900,
        height: 500
    };    

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));

        var barChart2 = new google.charts.Bar(document.getElementById('bar_chart2'));
        barChart2.draw(barData, barOptions);

        var barChart3 = new google.charts.Bar(document.getElementById('bar_chart3'));
        barChart3.draw(barDataultimomes, barOptionsultimomes);

        var barChart4 = new google.charts.Bar(document.getElementById('bar_chart4'));
        barChart4.draw(barDataano, barOptionano);
  
      }
    </script>



<style type="text/css">
/** Titulo **/
body {
  margin: 0;
  font-family: Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
}

h1 {
  font: 200 1.5em "Segoe UI Light", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
  font-weight: 200;
  color: white;
  background: #088A29;
  padding: 10px;
  margin: 0;
  
  strong {
    font-family: "Segoe UI Black";
    font-weight: normal;
  }
}
h2 {
	font: 200 0.9em "Segoe UI Light", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
  font-weight: 200;
  color: white;
  background: #088A29;
  padding: 10px;
  margin: 0;
  border-bottom: 13px solid #0B6121;
  strong {
    font-family: "Segoe UI Black";
    font-weight: normal;
  }
}
h3 {
  font: 200 2em Verdana;
}

.explanation {
  padding: 20px;
  max-width: 600px;
  p {
    max-width: 300px;
    color: #fff;
    font-size: 0.8rem;
  }
}
/* Botoes */



</style>


  </head>
  <body>
  <h1><img src="https://ctd.ifsp.edu.br/images/IFSP-CTD2.png" alt="Instituto Federal de São Paulo">Hidrometro IFSP - Campus Catanduva</h1>

<BR>

    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
<BR>
<BR>
<div id="bar_chart2"></div>

<BR>
<BR>
<div id="bar_chart3"></div>

<BR>
<BR>
<div id="bar_chart4"></div>
  </body>
</html>

<?php

mysqli_close($link);
$conn->close();
?>