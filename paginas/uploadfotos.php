<?php

	session_start();

	if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD']=='POST'){

		include('../functions/funcoes.php');
		include('../classes/DB.class.php');
		include('../classes/Allbuns.class.php');

		$album = (int)$_POST['album'];

		$uid = (int)$_POST['uid'];

		$fotos = $_FILES['fotos'];
		$nome = sha1($fotos['name'].$album.$uid).'.jpg';

		if (Albuns::addFotos($album,$uid,$nome)){

			upload($fotos['tmp_name'],$fotos['name'],$nome,500,'../uploads/fotos');
			echo 1;
			exit();
		}

	}
	echo 0;