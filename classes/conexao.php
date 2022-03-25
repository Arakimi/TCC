<?php
		
	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$banco = 'rede';
	
	$conectar = mysql_connect($host, $user, $pass);
	if($conectar){
		mysql_select_db($banco);
	}
?>