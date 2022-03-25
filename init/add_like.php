<?php
	session_start();
	sleep(2);
	include_once "../classes/conexao.php";
	include_once "../classes/funcoes.php";
	$id_artigo = (int)$_POST['id'];
	$id_usuario = (int)$_SESSION['socialisee_uid'];
	
	if(!verificar_clicado($id_artigo, $id_usuario)){
		if(adicionar_like($id_artigo, $id_usuario)){
			echo 'sucesso';
			
		}else{
			echo 'erro';
			
		}
	}else{
		echo 'erro';
	}
?>