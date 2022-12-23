<?php 
	
	$host = 'localhost';
	$user = 'ruben';
	$password = 'ruben';
	$db = 'facturacion';

	$conection = @mysqli_connect($host,$user,$password,$db);

	if(!$conection){
		echo "Error en la conexión";
	}

?>