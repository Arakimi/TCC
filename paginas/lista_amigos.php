
<?php 
	

/*Recebe os dados e uni as tabelas*/
 $selamigos= DB::getConn()->prepare('SELECT u.id, u.nome, u.sobrenome, u.img FROM usuario u INNER JOIN amizade a ON (((u.id=a.de) AND (a.para=?)) OR ((u.id=a.para) AND (a.de=?))) AND a.status=1');



$selamigos->execute(array($idExtrangeiro,$idExtrangeiro));

$numamigos = $selamigos->rowCount();

?>

	<!-- Lista de Amigos -->
	<span class="amigos-aviso">Amigos (<?php echo $numamigos ?>)</span>	
    <br>
	<ul class="amigosul">
		<center>
			<?php
				if($numamigos>0){

					while ($resAmigos= $selamigos->fetch(PDO::FETCH_NUM)) {
						/* Pega a foto de perfil do usuario ou se ele não tiver coloca a padrão */
						$imagemamigo = (file_exists('uploads/user/'.$resAmigos[3])) ? $resAmigos[3] : 'default_mas.png';
						/* Exibi os Amigos */
						echo '<li class="amigosli"><a href="perfil.php?uid='.$resAmigos[0].' "><img class="amigosimg"  src="uploads/user/'.$imagemamigo.'" alt="" title="'.$resAmigos[1].' '.$resAmigos[2].'" /></a></li>';
						}	
				}else{
					/* Se não existir amigos */
					echo '<br><br><br><span class="amigoserro">Nenhum Amigo Encontrado</span>
						<img src="./img/wind.png" width="150px" height="90px" class="nenhum-amigo-exibi-imagem"/>
						';
				}
			?>
		</center>
	</ul>
    </br>
    <span class="todosamigos"><a href="amigos.php?uid=<?php echo $idExtrangeiro?>">ver todos</a></span>