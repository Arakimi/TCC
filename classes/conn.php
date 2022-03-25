<?php
$host = "localhost"; 
$usuario = "root";
$senha = "";
$banco = "rede";
 
$conn = mysql_connect($host, $usuario, $senha);
$db = mysql_select_db($banco, $conn);
?>