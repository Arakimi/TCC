<?php 
	include('./classes/DBcrop.class.php');
	include('./classes/DBchat.class.php');

	$objLogin = new Login;
	
	/*VERIFICA SE ESTA LOGADO*/
	if(!$objLogin->logado()){ 
		include('login.php');
		exit();
	}
 
	exit();

	$idExtrangeiro = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['socialisee_uid'];
	$idDaSessao = $_SESSION['socialisee_uid'];


	if(isset($_POST['upload']) AND $_POST['upload'] == 'index'){
		$uid = $idDaSessao;
		$imgantiga = $_POST['imgantiga'];

		//Verifica se a imagem antiga existe na pasta 
		if($imgantiga<>'default.png' AND file_exists('../uploads/user/'.$imgantiga)){
			unlink('../uploads/user/'.$imgantiga);
		}

		include('funcoes.php');

		$imagem = $_FILES['foto-perfil'];
		$nome = sha1($imagem['name']).date('-his').'.jpg';

		$ext = array('image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/jpg');

		if(in_array($imagem['type'],$ext)){
			upload($imagem['tmp_name'],$imagem['name'],$nome,700,'../uploads/user');
			include('../classes/DB.class.php');
			$update = DB::getConn()->prepare('UPDATE `usuario` SET `img`=? WHERE `id`=?');
			$update->execute(array($nome,$uid));

			if(file_exists('../uploads/user/'.$nome)){
				echo "<script>location.href='index.php?index=CROP';</script>";		
				exit();
			}
		}

		
	}

	if(isset($_POST['salvar'])){
		$img = imagecreatefromjpeg('../uploads/user/'.$_POST['imagem']);
		$largura = 160;
		$altura = ($largura * $_POST['h']) / $_POST['w'];
		
		$nova = imagecreatetruecolor($largura,$altura);
		
		imagecopyresampled($nova,$img,0,0,$_POST['x'],$_POST['y'],$largura,$altura,$_POST['w'],$_POST['h']);
		imagejpeg($nova,'../uploads/user/'.$_POST['imagem'],80);
		header('Location: ../index.php');
	}
?>