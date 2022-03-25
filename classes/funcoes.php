<?php
	function get_artigos_by_id($id_rec){

		$selecionar = mysql_query("SELECT `id`,`recado`,`likes` FROM `recados` WHERE id = '$id_rec'") or die (mysql_error());
		
		$row = mysql_fetch_object($selecionar);

		$usuarioLogado = (int)$_SESSION['socialisee_uid'];
		$id_art = $row->id;
		$verificar = mysql_query("SELECT `like_id` FROM `likes` WHERE user_id = '$usuarioLogado' AND id = '$id_art'")  or die (mysql_error());
		$usr_liked = (mysql_num_rows($verificar) == 0) ? '0' : '1';

		$recado = array(
			'id' => $row->id,
			'titulo' => $row->recado,
			'likes' => $row->likes,
			'user_liked' => $usr_liked
		);
		
		
		return $recado;
	}

	function verificar_clicado($id_artigo, $id_usuario){
		$id_artigo = (int)$id_artigo;
		$id_usuario = (int)$id_usuario;
		$verificar = mysql_query("SELECT like_id FROM `likes` WHERE user_id = '$id_usuario' AND id = '$id_artigo'")  or die (mysql_error());
		return (mysql_num_rows($verificar) >= 1) ? true : false;
	}
	
	
	function adicionar_like($id_artigo, $id_usuario){
		$id_artigo = (int)$id_artigo;
		$id_usuario = (int)$id_usuario;
		$atualizar_likes_post = mysql_query("UPDATE `recados` SET likes = likes+1 WHERE id = '$id_artigo'")  or die (mysql_error());
		
		if($atualizar_likes_post){
			$inserir_like = mysql_query("INSERT INTO `likes` (user_id, id) VALUES ('$id_usuario','$id_artigo')")  or die (mysql_error());
			if($inserir_like){
				return true;
				
			}else{
				return false;
				
			}
		}
	}
	
	function retornar_likes($id_artigo){
		$id_artigo = (int)$id_artigo;
		$selecionar_num_likes = mysql_query("SELECT likes FROM `recados` WHERE id = '$id_artigo'")  or die (mysql_error());
		$fetch_likes = mysql_fetch_object($selecionar_num_likes);
		return $fetch_likes->likes;
	}

	function un_like($id_artigo, $id_user){
		$delete = mysql_query("DELETE FROM `likes` WHERE user_id = '$id_user' AND id = '$id_artigo'")  or die (mysql_error());
		if($delete){

			$update = mysql_query("UPDATE `recados` SET likes = likes-1 WHERE id = '$id_artigo'")  or die (mysql_error());
			if($update){
				return true;
			}else{
				return false;
			}

		}else{
			return false;
		}
	}
?>