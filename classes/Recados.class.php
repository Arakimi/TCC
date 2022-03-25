<?php 
 
	class Recados extends DB{

		static function setRecado($de,$para,$recado){

				$inserir = self::getConn()->prepare('INSERT INTO `recados` SET `de`=?, `para`=?, `recado`=?, `data`=NOW()');

				$para = ($para=='selecionar') ? 'amigos' : $para;

				if(is_array($para)){
				$num = count($para);
				for($r=0;$r<$num;$r++){
				$inserir->execute(array($de,$para[$r],$recado));
				}
				}else{
				$inserir->execute(array($de,$para,$recado));
				}	
				}

		static function getRecados($idDaSessao){
			$idDaSessao = $_SESSION['socialisee_uid'];
			$select = self::getConn()->prepare("SELECT u.id, u.nome, u.sobrenome, u.img, a.de, a.para, r.id, r.recado, r.de, r.para, r.data, r.status
				FROM usuario u 
				INNER JOIN recados r ON r.de=? OR r.para=? AND r.status = 1 
				INNER JOIN amizade a GROUP BY r.id ORDER BY r.data DESC ");

			$select->execute(array($idDaSessao,$idDaSessao));
			
			$d['num'] = $select->rowCount();
			$d['dados'] = $select->fetchAll();

			return $d; 

		}

		static function getRecadosPerfil($idExtrangeiro){
			$idDaSessao = $_SESSION['socialisee_uid'];
			$select = self::getConn()->prepare("SELECT u.id, u.nome, u.sobrenome, u.img, a.de, a.para, r.id, r.recado, r.de, r.para, r.data, r.status
				FROM usuario u 
				INNER JOIN recados r ON r.status= 1 AND r.de=? OR r.para=? 
				INNER JOIN amizade a GROUP BY r.id ORDER BY r.data DESC ");

			$select->execute(array($idExtrangeiro,$idExtrangeiro));
			
			$d['num'] = $select->rowCount();
			$d['dados'] = $select->fetchAll();

			return $d; 

		}

/*

select group_concat( receiver.sobrenome ) amigos, r.*, sender.*, receiver.* from recados r
join usuario sender on sender.id = r.de
join usuario receiver on receiver.id = r.para
group by sender.id

"SELECT u.id, u.nome, u.sobrenome, u.img, a.de, a.para, r.id, r.recado, r.de, r.para, r.data, r.status, a.status
				FROM usuario u 
				INNER JOIN recados r ON  r.de=? OR r.para=? OR r.para='amigos' OR r.para='publico' AND r.status= 1
				INNER JOIN amizade a ON a.de=? OR a.para=? AND a.status= 1 GROUP BY r.id ORDER BY r.data DESC"

*/

/*SELECT GROUP_CONCAT( receiver.sobrenome ) amigos, GROUP_CONCAT(receiver.id) ids, r.*, sender.*, receiver.* 
FROM recados r
JOIN usuario sender ON sender.id = r.de
JOIN usuario receiver ON receiver.id = r.para
GROUP BY sender.id


SELECT u.*, r.*
 FROM usuario u, recados r
 WHERE u.id = r.para*/

		static function getRecadosIndex($idDaSessao){
			$idDaSessao = $_SESSION['socialisee_uid'];
			$selected = self::getConn()->prepare("SELECT u.id, u.nome, u.sobrenome, u.img, a.de, a.para, r.id, r.recado, r.de, r.para, r.data, r.status, a.status
				FROM usuario u 
				INNER JOIN recados r ON r.status=1 AND r.de=? OR r.para=? OR r.para='amigos' OR r.para='publico'
				INNER JOIN amizade a ON a.de=? OR a.para=? AND a.status= 1 GROUP BY r.id ORDER BY r.data DESC"

);

			$selected->execute(array($idDaSessao,$idDaSessao,$idDaSessao,$idDaSessao));
			
			
			$d['num'] = $selected->rowCount();
			$d['dados'] = $selected->fetchAll();


			return $d;

		}

	}
?>