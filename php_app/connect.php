<?php
  
	session_start();

	if (!isset($_SESSION['dateOPR'])){
		$_SESSION['dateOPR'] = 0;
	}

	function Connection(){
		$server="localhost";   // endereço do banco de dados ou localhost para locais
		$user="root";  // usuario
		$pass="S&nh@123";  // senha
		$db="sensor";   // nome da base de dados criada em mysql>  create database sensor;

		$connection = mysqli_connect($server, $user, $pass) or die("Unable to Connect to '$server'");

		if (!$connection) {
		    die('MySQL ERROR: ' . mysqli_connect_error());
		}

		mysqli_select_db($connection,$db) or die( 'MySQL ERRO: '. mysqli_connect_error() );

		return $connection;
	}

?>
