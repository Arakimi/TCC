<?php
	include_once "../classes/conexao.php";
	include_once "../classes/funcoes.php";
	$id_artigo = (int)$_POST['id'];
	$numero_de_likes = retornar_likes($id_artigo);
	echo $numero_de_likes;
?>