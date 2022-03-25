<?php
	sleep(1);
	include_once "../classes/conexao.php";
	include_once "../classes/funcoes.php";

	$id_artigo = (int)$_POST['id'];
	$user_id = (int)$_POST['user_id'];

	if(un_like($id_artigo, $user_id)){
		echo 'sucesso';
	}else{
		echo 'erro';
	}
?>