<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		#sombra {
			-webkit-box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
			-moz-box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
			box-shadow: 6px 9px 7px 0px rgba(176,176,176,0.75);
		}

	</style>
</head>
<body >

<?php   
date_default_timezone_set('America/Sao_Paulo');
//echo date_default_timezone_get() . ' => ' . date('e') . ' => ' . date('T');
//echo "<BR>";
//echo date('l jS \of F Y h:i:s A');

 $buscames=$_GET['buscames'];
 $buscadia=$_GET['buscadia'];
 $buscaano=$_GET['buscaano'];
if(!$buscames) {  $buscames=date('m');  }
if(!$buscadia) {  $buscadia=date('d');  }
if(!$buscaano) {  $buscaano=date('Y');  }
$databusca = $buscaano."-".$buscames."-".$buscadia;
?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card text-white bg-primary mb-3" style="max-width: 18rem;" id="sombra">
					<div class="card-header">Consumo Diário Entrada</div>
					<div class="card-body" >
						<h5 class="card-title" style="text-align: center;font-size: 40px">
							<?php
 
							include 'conexao/conexao.php';
							$sql = "select sum(dif_entrada) as somaentrada, sum(dif_horta) as somahorta, cast(time as date) as dia,hour(time) as hora, DATE_FORMAT(time, '%e/%M/%Y %H:%i:%s') as horaatual from hidrometro_ifsp WHERE date(time) = '$databusca';"; // 
							// $sql = "SELECT SUM(tempsolar1) AS total  from solar_tracker_temperatura";
							$consulta = mysqli_query($conexao,$sql);
							$dados = mysqli_fetch_array($consulta);
							$somaentrada = number_format($dados['somaentrada']);
							$somahorta = number_format($dados['somahorta']);
							$ultimadata = number_format($dados[' horaatual']);
							echo $somaentrada;
							?>
							<span style="font-size: 10px">  litros (<?php echo $buscadia."/".$buscames."/".$buscaano; ?>)</span></h5>

						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card text-white bg-success mb-3" style="max-width: 18rem;" id="sombra">
						<div class="card-header">Consumo Diário Horta</div>
						<div class="card-body">
							<h5 class="card-title" style="text-align: center;font-size: 40px">
								<?php

								
								echo $somahorta;

								?>

								<span style="font-size: 10px"> Litros  (<?php echo $buscadia."/".$buscames."/".$buscaano; ?>)</span></h5>

							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card text-white bg-primary mb-3" style="max-width: 18rem;" id="sombra">
							<div class="card-header">Consumo mensal Entrada</div>
							<div class="card-body">
								<h5 class="card-title" style="text-align: center;font-size: 40px">
									<?php
									include 'conexao/conexao.php';
									$sql3 = "select sum(dif_entrada) as somaentradames, sum(dif_horta) as somahortames,  DATE_FORMAT(time, '%e') as dia from hidrometro_ifsp  WHERE MONTH(time)= $buscames ;"; // 
									$consulta = mysqli_query($conexao,$sql3);
									$dados = mysqli_fetch_array($consulta);
								     $somaentradames= $dados['somaentradames'];
									 $somahortames= $dados['somahortames'];
									echo number_format($somaentradames,0,'.','');


									?>
									<span style="font-size: 10px">  litros  (<?php echo $buscames."/".$buscaano; ?>)</span></h5>

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-md-4">
						<div class="card text-white bg-success mb-3" style="max-width: 18rem;" id="sombra">
							<div class="card-header">Consumo Mensal Horta</div>
							<div class="card-body">
								<h5 class="card-title" style="text-align: center;font-size: 40px">
									<?php
			
									echo number_format($somahortames,0,'.','');


									?>
									<span style="font-size: 10px">  litros (<?php echo $buscames."/".$buscaano; ?>)</span></h5>

								</div>
							</div>
						</div>

					</div>
				</div>




			</body>
			</html>