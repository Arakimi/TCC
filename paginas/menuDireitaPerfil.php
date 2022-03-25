<?php

	//Verifica Quantidade de amigos
	$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? OR de=? AND `status`=1 ');
    $e_meu_amigo->execute(array($idExtrangeiro,$idExtrangeiro));
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

<div id="right-perfil">
	<ul>
		<li> 
			<a href="perfil.php?uid=<?php echo $idExtrangeiro?>">
				<img src="./img/postagensPerfil.png" width="20px" height="25px"><br>
				<span class="perfil-info">Perfil</span><br>
				<span class="perfil-info-numero"><?php echo $quantidadePostagens; ?></span>
			</a>
		</li>
		<li>
			<a href="pamigos.php?uid=<?php echo $idExtrangeiro?>">
				<img src="./img/amigosPerfil.png" width="25px" height="30px"><br>
				<span class="perfil-info">Amigos</span><br>
				<span class="perfil-info-numero"><?php echo $quantidade; ?></span>
			</a>
		</li>
		<li>
			<a href="palbum.php?uid=<?php echo $idExtrangeiro?>">
				<img src="./img/fotoPerfil.png" width="25px" height="25px"><br>
				<span class="perfil-info">Fotos</span><br>
				<span class="perfil-info-numero"><?php echo $quantidadeFotos; ?></span>
			</a>
		</li>
		<li>
			<a href="pvideos.php?uid=<?php echo $idExtrangeiro?>">
				<img src="./img/videoPerfil.png" width="25px" height="25px"><br>
				<span class="perfil-info">Videos</span><br>
				<span class="perfil-info-numero"><?php echo $quantidadeVideos; ?></span>
			</a>
		</li>
		<li>
			<a href="">
				<img src="./img/postIcon.png" width="20px" height="25px"><br>
				<span class="perfil-info">Paginas</span><br>
				<span class="perfil-info-numero">0</span>
			</a>
		</li>
		<?php
		echo'<li>
			<a href="">';
				 
				
                    if($idDaSessao<>$idExtrangeiro){

                        $e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
                        $e_meu_amigo->execute(array($idDaSessao,$idExtrangeiro,$idDaSessao,$idExtrangeiro));

                        if ($e_meu_amigo->rowCount() == 0) {
                            echo '<a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$idExtrangeiro.'">
                            	<img src="./img/solicitaPerfilAceitar.png" width="30px" height="30px"><br>
                            	<span class="perfil-info">Adicionar</span>
                            </a>';
                            }else{
                                $asstatusamizade = $e_meu_amigo->fetch(PDO::FETCH_ASSOC);
                            if($asstatusamizade['status'] == 0){
                                echo '
                                <a class="pedir-amizade-a" href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$idExtrangeiro.'">
                                   <img src="./img/solicitaPerfilCancelar.png" width="30px" height="30px"><br>
                                    <span class="perfil-info">Cancelar Solicitação</span>
                                                                                          
                                    
                                    
                                </a>';
                            }else{
                                echo '
                                <a class="pedir-amizade-a" href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$idExtrangeiro.'">
                                	<img src="./img/solicitaPerfilCancelar.png" width="30px" height="30px"><br>
                                	<span class="perfil-info">Remover amigo</span>
                                    	
                                
                                	
                                </a>';
                            }


                        }  

                    }
                						
			echo'</a>
		</li>';
		?>
		<?php
                    if($idDaSessao<>$idExtrangeiro){
			echo'<li>
				<a href="#bg-modal-denunciar-perfil">				
					<img src="./img/denunciarPerfil.png" width="27px" height="25px"><br>
					<span class="perfil-info">Denunciar</span>
				</a>			
			</li>';}
			?>
	</ul>
	<br>
</div>