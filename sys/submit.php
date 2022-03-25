<?php
	if(isset($_POST['mensagem'])){
		include_once('../classes/DB.class.php');
		DB::getConn();


		date_default_timezone_set('America/Sao_Paulo');
		$data = date("Y/m/d H:i:s "); 

		$mensagem = utf8_decode( strip_tags(trim(filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING))) );
		$de = (int)$_POST['de'];
		$para = (int)$_POST['para'];

		if($mensagem != ''){
			$insert = DB::getConn()->prepare("INSERT INTO `mensagens` (id_de, id_para, mensagem, time, env, lido) VALUES (?, ?, ?, ?, ?, ?)");
			$arrayInsert = array($de, $para, $mensagem, time(), $data, 0);
			if($insert->execute($arrayInsert)){
				echo 'ok';
			}else{
				echo 'no';
			}
		}
	}
?>