<?php
	//Verifica Quantidade de pedidos de amizade
	$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? AND `status`=0 ');
    $e_meu_amigo->execute(array($idExtrangeiro));
	$quantidade = $e_meu_amigo->rowcount();

	//Verifica Quantidade de Videos Cadastrados
	$meus_videos = DB::getConn()->prepare('SELECT * FROM `video` WHERE usuario=?');
    $meus_videos->execute(array($idExtrangeiro));
	$quantidadeVideos = $meus_videos->rowcount();

	//Verifica Quantidade de Postagens Cadastrados
	$meus_posts = DB::getConn()->prepare('SELECT * FROM `recados` WHERE de=?');
    $meus_posts->execute(array($idExtrangeiro));
	$quantidadePostagens = $meus_posts->rowcount();

	//Verifica Quantidade de fotos Cadastradas
	$minhas_fotos = DB::getConn()->prepare('SELECT * FROM `foto` WHERE usuario=?');
    $minhas_fotos->execute(array($idExtrangeiro));
	$quantidadeFotos = $minhas_fotos->rowcount();
?>
<br>
<div id="menu">
	<br>
	<ul>
		<li><a href="config.php?uid=<?php echo $idDaSessao?>"><img src="img/configIcon.png"/ width="15px"> Editar Perfil</a></li>
		<li>
			<a href="solicitacao.php?uid=<?php echo $idExtrangeiro?>">
				<img src="img/solicitaIcon.png" width="15px"/> 
				Solicitações de Amizade (<?php echo $quantidade; ?>)
			</a>
		</li>
		<li>
			<a href="">
				<img src="img/postIcon.png" width="12px"/> 
				Minhas Postagens (<?php echo $quantidadePostagens; ?>)
			</a>
		</li>
		<li>
			<a href="videos.php?uid=<?php echo $idExtrangeiro; ?>">
				<img src="img/videosIcon.png" width="15px"/> 
				Meus Videos (<?php echo $quantidadeVideos; ?>)
			</a>
		</li>
		<li>
			<a href="album.php?uid=<?php echo $idExtrangeiro?>">
				<img src="img/fotoIcon.png" width="15px"/> 
				Minhas Fotos (<?php echo $quantidadeFotos; ?>)
			</a>
		</li>
		<li><a href=""><img src="img/criacaoIcon.png" width="15px"/> Opções de Criação</a></li>
		<li><a href=""><img src="img/jogosIcon.png " width="15px"/> Jogos</a></li>
		<br>
	</ul>
</div>