<?php
include("connect.php");

$link = Connection();


$sql = "select sum(dif_entrada) as soma, cast(time as date) as dia,hour(time) as hora from hidrometro_ifsp WHERE time > date_sub(now(),interval 1 day) group by cast(time as date), hour(time);"; // 

$result = mysqli_query($link, $sql);

$tr = mysqli_num_rows($result); // verifica o número total de registros

echo $tr.'<br>'; 
$total=0;
if (mysqli_num_rows($result)) {     
    $i=0;
      while ($row = $result->fetch_assoc()) {
         
          $hora = $row["hora"];
          $soma = $row["soma"]; 
          $total=$total+$soma;
          echo ' ' . $i . '|' . $hora . '|' . $soma. '<br>'; 
                $i++;
              }
      $result->free();
  }
  echo '<P>' . $total . 'litros últimas 24 horas<BR>';

  echo date('m') . '<br />';

mysqli_close($link);
$conn->close();
?>
