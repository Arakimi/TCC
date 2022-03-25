<?php

	require_once('../classes/DB.class.php');

	$nome = $_POST['nome'];
	$sobrenome = $_POST['sobrenome'];
	$sexo = $_POST['sexo'];
	$cabelo = $_POST['cabelo'];
	$olhos = $_POST['olhos'];
	$relacionamento = $_POST['relacionamento'];
	$ddd = $_POST['ddd1'];
	$telefone = $_POST['telefone']; 
	$id = $_POST['idUser'];

	if($nome == '' OR strlen($nome)<3){
		echo '<script>alert("O nome deve conter mais de 3 caracteres !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($sobrenome == '' OR strlen($sobrenome)<3){
		echo '<script>alert("O Sobrenome deve conter mais de 3 caracteres !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($sexo == ''){
		echo '<script>alert("Preencha o campo Sexo !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($cabelo == ''){
		echo '<script>alert("Preencha o campo Cabelo !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($olhos == ''){
		echo '<script>alert("Preencha o campo Olhos !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($relacionamento == ''){
		echo '<script>alert("Preencha o campo Relacionamento !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($ddd == '' OR strlen($ddd)<2){
		echo '<script>alert("O Campo DDD deve conter 2 caracteres");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($telefone == '' OR strlen($telefone)<9){
		echo '<script>alert("O Campo Telefone deve conter 9 digitos");</script>';
		header("Location: ../config.php?uid=$id");
	}else{
		$atualiza = DB::getConn()->prepare('UPDATE `usuario` SET `nome` =?, `sobrenome` =?, `sexo` =?, `cabelo` =?, `olhos` =?, `relacionamento` =?, `ddd` =?, `celular` =? WHERE `id` =? ');
		$atualiza->execute(array($nome, $sobrenome, $sexo, $cabelo, $olhos, $relacionamento, $ddd, $telefone, $id));
		$row = $atualiza->rowCount();

		header("Location: ../config.php?uid=$id");
	}

?>