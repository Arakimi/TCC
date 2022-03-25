<?php 
	include('../classes/DB.class.php');


	if(''<>$_GET['ac']){

		if($_GET['ac']=='convite'){
			
			/* Manda o convite */
			$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
            $e_meu_amigo->execute(array($_GET['de'],$_GET['para'],$_GET['de'],$_GET['para']));
			/* Insere no banco o convite */

            if($e_meu_amigo->rowcount()==0){

				$convite = DB::getConn()->prepare('INSERT INTO `amizade` SET `de` =?, `para`=?, `status`=0');
				$convite->execute(array($_GET['de'],$_GET['para']));
		

				header('Location: ../perfil.php?uid='.$_GET['para']);

			}

		}
	
		/* Cancela o pedido de amizade e Remove a amizade */
		if($_GET['ac']=='remover'){

			
			$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
            $e_meu_amigo->execute(array($_GET['de'],$_GET['para'],$_GET['de'],$_GET['para']));

            if($e_meu_amigo->rowcount()==1){

				$convite = DB::getConn()->prepare('DELETE FROM  `amizade` WHERE `id`=?');
				$convite->execute(array($_GET['id']));
		

				header('Location: ../index.php');

			}

		}
		/*  Aceita o pedido da amizade */
		if($_GET['ac']=='aceitar'){

			
			$convite = DB::getConn()->prepare('UPDATE `amizade` SET `status` =1 WHERE `id` =?');
            $convite->execute(array($_GET['id']));
		

				header('Location: ../index.php');



		}

	}



?>