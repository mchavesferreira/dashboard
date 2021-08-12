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

//include("connect.php");

$link = Connection();


$sqltodos = "SELECT time, entrada, horta, dif_horta, dif_entrada FROM hidrometro_ifsp ORDER BY time ASC "; // 

$result = mysqli_query($link, $sqltodos);


$tr = mysqli_num_rows($result); // verifica o número total de registros


echo "numero de linhas:";
echo $tr;
echo "<BR>";

    //  mysqli_close($link);

if (mysqli_num_rows($result)) {     
  $i=0;
    while ($row = $result->fetch_assoc()) {
       
        $row_value1 = $row["entrada"];
        $row_value2 = $row["horta"]; 
       
        if($i==0) { $entradaanterior=$row_value1; $hortaanterior=$row_value2; }
          
        $diferencaentrada=$row_value1-$entradaanterior;
        $entradaanterior=$row_value1;
        
        $diferencahorta=number_format($row_value2-$hortaanterior, 2);
        if($diferencahorta<0)$diferencahorta=0;
        $hortaanterior=$row_value2;

    
        $row_value3 = $row["time"]; 
        $sqlajuste = "UPDATE hidrometro_ifsp SET dif_horta = $diferencahorta, dif_entrada = $diferencaentrada WHERE time='$row_value3'";
        $resultajuste = mysqli_query($link, $sqlajuste);
         $i++;
            }
    $result->free();
}

?> 
</table> <P>
<BR>
<?php

mysqli_close($link);
$conn->close();
?>

</body>
</html>
