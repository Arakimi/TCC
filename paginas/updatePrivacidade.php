<?php
	
	require_once('../classes/DB.class.php');

	$ecelular = $_POST['ecelular'];
	$elocalizacao = $_POST['elocalizacao'];
	$ebusca = $_POST['ebusca'];
	$ramizade = $_POST['ramizade'];
	$id = $_POST['idUser'];

	if($ecelular == ''){
		echo '<script>alert("Preencha o campo Celular !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($elocalizacao == ''){
		echo '<script>alert("Preencha o campo Localização !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($ebusca == ''){
		echo '<script>alert("Preencha o campo Busca !");</script>';
		header("Location: ../config.php?uid=$id");
	}else if($ramizade == ''){
		echo '<script>alert("Preencha o campo Amizade !");</script>';
		header("Location: ../config.php?uid=$id");
	}else{
		$atualiza = DB::getConn()->prepare('UPDATE `usuario` SET `vcelular`=?, `elocalizacao`=?, `pesq`=?, `pedidosa`=? WHERE `id`=? ');
		$atualiza->execute(array($ecelular, $elocalizacao, $ebusca, $ramizade, $id));
		$row = $atualiza->rowCount();

		header("Location: ../config.php?uid=$id"); 
	}
?>