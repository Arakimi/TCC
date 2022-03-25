<?php
include ('./classes/conexao.php');
   $objLogin = new Login;
	
	/*VERIFICA SE ESTA LOGADO*/
	if(!$objLogin->logado()){
		include('login.php');
		exit();
	}

	$idExtrangeiro = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['socialisee_uid'];
	$idDaSessao = $_SESSION['socialisee_uid'];

	$data0 = date('md');
	$data= (int)$data0;
    $niver1 = DB::getConn()->prepare("SELECT usuario.id, usuario.nome, usuario.sobrenome, usuario.nascimento, usuario.img, amizade.de, amizade.para, amizade.status
        	FROM usuario
        	INNER JOIN amizade 
        	ON ((usuario.id=amizade.de) 
        	AND (amizade.para=?))
        	OR ((usuario.id=amizade.para) 
        	AND (amizade.de=?))
        	AND usuario.nascimento = ?
        	AND amizade.status=1");
    $niver1->execute(array($idDaSessao,$idDaSessao,$data));
	$niver2['num'] =$niver1->rowCount();
	$niver2['dados'] =$niver1->fetchAll();


	//	$amigo = mysql_num_rows($amigo1);
	//$amigo->execute(array($idDaSessao,$idDaSessao));
	//$selamigo =  DB::getConn()->prepare('SELECT * FROM `amizade`');
	//$amigo1['num'] = $selamigo->rowCount();
	//$amigo1['dados'] = $selamigo->fetchAll();
	foreach($niver2['dados'] as $niver) : 
		if ($niver[7]==1 AND $niver[3] == $data){
		$fullname = $niver['nome'].' '.$niver['sobrenome'];
		$foto = $niver['img'];
		echo '<div class="aniversario"><br>	
				<div class="textoAniver">					
					<span>Aniversariantes de hoje:</span><br>
				</div>
				<img src="uploads/user/'.$foto.'" width="60px" height="60px"/>
				<br><a href="perfil.php?uid='.$niver['id'].'"> '.$fullname.'</a><br>
				<span class="aniMensagem">deseje feliz aniversario</span>
				<br />
			</div>'; 


	}

	endforeach;


?>
