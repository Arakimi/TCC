<?php
	if(isset($_POST['conversacom'])){
		include_once('../classes/DB.class.php');
		DB::getConn();

		$mensagens = array();
		$id_conversa = (int)$_POST['conversacom'];
		$online = (int)$_POST['online'];

		$pegaConversas = DB::getConn()->prepare("SELECT * FROM `mensagens` WHERE (`id_de` = ? AND `id_para` = ?) OR (`id_de` = ? AND `id_para` = ?) ORDER BY `id` DESC LIMIT 10");
		$pegaConversas->execute(array($online, $id_conversa, $id_conversa, $online));

		while($row = $pegaConversas->fetch()){
			$fotouser = '';
			if($online == $row['id_de']){
				$janela_de = $row['id_para'];
			}else if($online == $row['id_para']){
				$janela_de = $row['id_de'];
				$pegaFoto = DB::getConn()->prepare("SELECT `img` FROM `usuario` WHERE `id` = $row[id_de]");
				$pegaFoto->execute();
				
				while($usr = $pegaFoto->fetch()){
				$fotouser = ($usr['img'] == '') ? 'default.png' : $usr['img'];
			}
				
			}

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
			
			$msg = str_replace($emotions, $imgs , $row['mensagem']);
			$mensagens[] = array(
				'id' => $row['id'],
				'mensagem' => utf8_encode($msg),
				'fotoUser' => $fotouser,
				'id_de' => $row['id_de'],
				'id_para' => $row['id_para'],
				'janela_de' => $janela_de
			);

		}
		die(json_encode($mensagens));
		
	}
	
?>