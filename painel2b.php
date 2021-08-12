<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart', 'line','bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['hora', 'entrada', 'horta' ],

          <?php

          include 'conexao/conexao.php';
          $sql = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta, cast(time as date) as dia,hour(time) as hora, DATE_FORMAT(time, '%e/%M/%Y %H:%i:%s') as horaatual from hidrometro_ifsp WHERE time > date_sub(now(),interval 1 day) group by cast(time as date), hour(time);"; // 
          $buscar = mysqli_query($conexao,$sql);

          while ($row = mysqli_fetch_array($buscar)) {

            $hora = $row["hora"];
            $soma = $row["soma"]; 
            $somahorta = $row["somahorta"]; 
            $dia = $row["dia"]; 
            $horaatual = $row["horaatual"]; 
            $total=$total+$soma;
            $totalhorta=$totalhorta+$somahorta;
       
            echo "[ '" . $hora . "' , " . $soma. " ,  " . $somahorta. " ],"; 

         } ?>
          ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: 'Consumo de água por Hora',
        subtitle: 'Últimas 24 horas: Entrada: <?php echo $total; ?> litros, Horta: <?php     echo number_format($totalhorta); ?> litros. (última atualização: <?php echo $horaatual; ?> )',

        //width: 900,
        height: 400,
        bar: {groupWidth: "75%"},
        legend: { position: "top" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_diario"));
      chart.draw(view, options);
     }
   </script>

<?php  ////////////////////////// dados das ultimo mes ////////////////////////
$buscames=$_GET['buscames'];
if(!$buscames) {  $buscames=date('m');  } 

?>

   <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart','line','bar']});
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {

      var barDataultimomes = google.visualization.arrayToDataTable([
        ['dia', 'entrada', 'hortA'],
        <?php

        include 'conexao/conexao.php';
        $sql3 = "select sum(dif_entrada) as soma, sum(dif_horta) as somahorta,  DATE_FORMAT(time, '%e') as dia from hidrometro_ifsp  WHERE MONTH(time)= $buscames group by cast(time as date), day(time);"; // 
        $buscar = mysqli_query($conexao,$sql3);
        $totalmes=0;
        $totalhortames=0;
        while ($row3 = mysqli_fetch_array($buscar)) {

          $soma = $row3["soma"]; 
          $somahortames = $row3["somahorta"]; 
          $dia = $row3["dia"]; 
          $totalmes=$totalmes+$soma;
          $totalhortames=$totalhortames+$somahortames;

          echo "[ '" . $dia . "' , " . $soma. " , " . $somahortames. "],"; 

       } ?>
        ]);

   

    var barOptionsultimomes = {
          chart: {
            title: 'Consumo de água por dia do mês <?php echo $buscames; ?>',
            subtitle: 'Consumo do mês: Entrada: <?php echo $totalmes; ?> litros, Horta: <?php     echo number_format($totalhortames); ?> litros. (última atualização: <?php echo $horaatual; ?> )',
            },
            legend: { position: "top" },
            width: 800,
            height: 500
              };

        var chart2 = new google.charts.Bar(document.getElementById('bar_chart2'));
        chart2.draw(barDataultimomes, google.charts.Bar.convertOptions(barOptionsultimomes));

    


    }
  </script>

<style type="text/css">
    .sombra {
      -webkit-box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
      -moz-box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
      box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
    }

  </style>
  

</head>
<body>

  <div class="container-fluid" style="margin-top: 40px">
    <div class="row">
      <div class="col-md-8">
        <h4>Hidrômetro</h4>
        <div id="columnchart_diario" class="sombra"></div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-8">
        <div id="bar_chart2" class="sombra"></div>
      </div>
   </div>
  </div>



</body>
</html>


  