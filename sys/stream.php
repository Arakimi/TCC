<?php
	
	if(isset($_GET)){
		include_once('../classes/DB.class.php');
		DB::getConn();

		$userOnline = (int)$_GET['user'];
		$timestamp = ($_GET['timestamp'] == 0) ? time() : strip_tags(trim($_GET['timestamp']));
		$lastid = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;

		if(empty($timestamp)){
			die(json_encode(array('status'=> 'erro')));
		}
		$tempoGasto = 0;
		$lastidQuery = '';

		if(!empty($lastid)){
			$lastidQuery = ' AND `id` > '.$lastid;
		}

		if($_GET['timestamp'] == 0){
			$verifica = DB::getConn()->prepare("SELECT * FROM `mensagens` WHERE `lido` = 0 ORDER BY `id` DESC ");
		}else{
			$verifica = DB::getConn()->prepare("SELECT * FROM `mensagens` WHERE `time` <= $timestamp".$lastidQuery." AND `lido` = 0 ORDER BY `id` DESC");
		}
		$verifica->execute();
		$resultados = $verifica->rowCount();

		if($resultados <= 0){
			while($resultados <= 0){
				if($resultados <= 0){
					//Ficar 30 segundos verificando
					if($tempoGasto >= 30){
						die(json_encode(array('status' => 'vazio', 'lastid' => 0, 'timestamp' => time())));
						exit();
					}

					//Pausa Script por 1 segundo
					sleep(1);
					$verifica = DB::getConn()->prepare("SELECT * FROM `mensagens` WHERE `time` <= $timestamp".$lastidQuery." AND `lido` = 0 ORDER BY `id` DESC");
					$resultados = $verifica->rowCount();
					$tempoGasto += 1;

				}
			}
		}

		$novasMensagens = array();
		if($resultados >= 1){
			$emotions = array(':=(', 'O.o', ':X', ':D', ':3', ':(', ';)');
			$imgs = array(
				'<img src="./uploads/emoticon/cry.png" width="40" />',
				'<img src="./uploads/emoticon/what.png" width="40" />',
				'<img src="./uploads/emoticon/urgh.png" width="40" />',
				'<img src="./uploads/emoticon/nice.png" width="14" />',
				'<img src="./uploads/emoticon/nice.png" width="14" />',
				'<img src="./uploads/emoticon/nice.png" width="14" />',
				'<img src="./uploads/emoticon/nice.png" width="14" />'
			);
			

			while($row = $verifica->fetch()){
				$fotoUser = '';
				$janela_de = 0;
				/*SE FOI EU QUE MANDEI A MENSAGEM NAO PEGO A FOTO*/
				if($userOnline == $row['id_de']){
					$janela_de = $row['id_para'];
				}else if($userOnline == $row['id_para']){/*SE FOI OUTRA PESSOA QUE MANDOU A MENSAGEM PEGA A FOTO*/
					$janela_de = $row['id_de'];
					$pegaUsr = DB::getConn()->prepare("SELECT `img` FROM `usuario` WHERE `id` = '$row[id_de]'");
					$pegaUsr-> execute();
					while($usr = $pegaUsr->fetch()){
						$fotoUser = ($usr['img'] == '') ? 'default.png' : $usr['img'];
					}
				}

				$msg = str_replace($emotions, $imgs , $row['mensagem']);
				$novasMensagens[] = array(
					'id' => $row['id'],
					'mensagem' => utf8_encode($msg),
					'fotoUser' => $fotoUser,
					'id_de' => $row['id_de'],
					'id_para' => $row['id_para'],
					'janela_de' => $janela_de
				);

			}
		}
		$ultimaMsg = end($novasMensagens);
		$ultimoId = $ultimaMsg['id'];
		die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'dados' => $novasMensagens)));






	}	

?>