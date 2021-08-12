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


$sql = "select sum(dif_entrada) as soma, cast(time as date) as dia,hour(time) as hora from hidrometro_ifsp WHERE time > date_sub(now(),interval 1 day) group by cast(time as date),hour(time);"; // 

$result = mysqli_query($link, $sql);

$tr = mysqli_num_rows($result); // verifica o número total de registros


echo "numero de linhas:";
echo $tr;
echo "<BR>";


echo '<table cellspacing="5" cellpadding="5" border=1>
      <tr> 
        <td>amostra</td> 
        <td>hora</td> 
        <td>soma L</td> 
      </tr>';
 
    //  mysqli_close($link);

if (mysqli_num_rows($result)) {     
  $i=0;
    while ($row = $result->fetch_assoc()) {
       
        $row_value1 = $row["hora"];
        $row_value2 = $row["soma"]; 
 
        echo '<tr> 
              <td>' . $i . '</td> 
                <td>' . $row_value1 . '</td> 
                <td>' . $row_value2 . '</td> 
          
          
              </tr>'; 
              $i++;
            }
    $result->free();
}

?> 
</table> <P>
<BR>
<?php


  

?>

</body>
</html>
