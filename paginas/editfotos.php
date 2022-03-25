<?php 

	session_start();
	$uid = $_SESSION['socialisee_uid'];
	include('../classes/DB.class.php');
	include('../classes/Allbuns.class.php');
	

	if(isset($_POST['album'])){

		$capa= $_POST['capa'];
		$album =(int)$_POST['album'];



		if(Albuns::meuAlbum($album, $uid)){

			Albuns::editAlbum($album,array('capa'=>$capa));

		}

	}

	if(isset($_POST['foto'])){
		

		//$id = end(explode('-',$_POST['foto']));
		$a = explode ( '-' , $_POST['foto'] );
		$id = end ($a); unset( $a ); 

		$legenda = strip_tags(trim($_POST['legenda']));
		
		$result = Albuns::minhaFoto($id,$uid); 
		if($result['res']){

			Albuns::editFotos($id,array('legenda'=>$legenda));
		}
	}

