<?php

	include_once('../classes/DB.class.php');

	$pais = $_POST['pais'];
	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];
	$id = $_POST['idUser'];

	if($pais == '' OR $estado == '' OR $cidade == ''){
		echo '<script>alert("Informe todos os campos antes de atualizar !")</script>';
	}else{
		$atualiza = DB::getConn()->prepare('UPDATE `usuario` SET `pais`=?, `estado`=?, `cidade`=? WHERE `id`=?');
		$atualiza->execute(array($pais, $estado, $cidade, $id));
		$row = $atualiza->rowCount();
		header("Location: ../index.php");
	}
	
?>