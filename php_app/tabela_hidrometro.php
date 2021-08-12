<!DOCTYPE html>
<html><body>
Tabela <BR>
<?php
/*
https://randomnerdtutorials.com/esp32-esp8266-mysql-database-php/

Adaptacao Marcos Chaves // dados no formato tabela
*/
/*


$inicio = $pc - 1;
$inicio = $inicio * $total_reg;
*/
$total_reg=100;  // numero de amostras por pagina
$pagina=$_GET['pagina'];
if (!$pagina) { $pc = 1; } else { $pc = $pagina; }
$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

include("connect.php");

$link = Connection();


$sql = "SELECT time, entrada, horta, dif_horta, dif_entrada FROM hidrometro_ifsp ORDER BY time DESC LIMIT $inicio,$total_reg"; // 

$result = mysqli_query($link, $sql);

$sqltodos = "SELECT time, entrada, horta, dif_horta, dif_entrada FROM hidrometro_ifsp ORDER BY time ASC "; // 
$todos = mysqli_query($link, $sqltodos);

$tr = mysqli_num_rows($todos); // verifica o número total de registros
$tp = $tr / $total_reg; // verifica o número total de páginas


echo "numero de linhas:";
echo $tr;
echo "<BR>";


echo '<table cellspacing="5" cellpadding="5" border=1>
      <tr> 
        <td>amostra</td> 
        <td>Timestamp</td> 
        <td>Entrada</td> 
        <td>Consumo</td>
        <td>Horta</td> 
        <td>Consumo</td>
        
      </tr>';
 
    //  mysqli_close($link);

if (mysqli_num_rows($result)) {     
  $i=0;
    while ($row = $result->fetch_assoc()) {
       
        $row_value1 = $row["entrada"];
        $row_value2 = $row["horta"]; 
        $diferencaentrada= $row["dif_entrada"]; 
        $diferencahorta= $row["dif_horta"]; 
        $row_value3 = $row["time"]; 
  
        echo '<tr> 
              <td>' . $i . '</td> 
              <td>' . $row_value3 . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $diferencaentrada . '</td>
                <td>' . $row_value2 . '</td> 
                <td>' . $diferencahorta . '</td>
          
          
              </tr>'; 
              $i++;
            }
    $result->free();
}

?> 
</table> <P>
<BR>
<?php

$anterior = $pc -1;
$proximo = $pc +1;
if ($pc>1) {
echo '  <a href=?pagina='.$anterior.'><- Anterior</a> ';
}
echo '|';
if ($pc<$tp) {
echo ' <a href=?pagina=' . $proximo. '>Próxima -></a>'  ;
}

mysqli_close($link);
$conn->close();
?>

</body>
</html>
