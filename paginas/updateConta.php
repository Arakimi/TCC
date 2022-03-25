<?php
	require_once('../classes/DB.class.php');

	$senhaAntiga = $_POST['senhaAntiga'];
	$senhaNova = $_POST['senhaNova'];
	$senhaConfirma = $_POST['senhaNovaConfirma'];
	$id = $_POST['idUser'];

	$verifica = DB::getConn()->prepare('SELECT `senha` FROM `usuario` WHERE id = ?');
	$verifica->execute(array($id));
	$veriSenha = $verifica->fetch(PDO::FETCH_NUM);
	
	$senhaIncriptadoBanco = $veriSenha[0];
	$senhaAntigaCripto = hash('sha512', $senhaAntiga);
	$senhaNovaCripto = hash('sha512', $senhaNova);

	if($senhaAntigaCripto == $senhaIncriptadoBanco AND $senhaNova == $senhaConfirma AND strlen($senhaNova)>8 AND strlen($senhaNova)<32 ){
		$atualiza = DB::getConn()->prepare('UPDATE `usuario` SET `senha`=? WHERE id=?');
		$atualiza->execute(array($senhaNovaCripto, $id));
		$row = $atualiza->rowCount();	
		header("Location: ../index.php");
	}else{
		echo '<script>alert("Não foi Possivel Alterar a senha !")</script>';
	}

?>