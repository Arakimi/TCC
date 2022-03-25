<?php 

/*Recebe os dados e uni as tabelas*/
 $selamigos= DB::getConn()->prepare('SELECT u.id, u.nome, u.sobrenome, u.img, u.capa, u.ano, u.relacionamento FROM usuario u INNER JOIN amizade a ON (((u.id=a.de) AND (a.para=?)) OR ((u.id=a.para) AND (a.de=?))) AND a.status=1');



$selamigos->execute(array($idExtrangeiro,$idExtrangeiro));

$numamigos = $selamigos->rowCount();




?>

	<!-- Lista de Amigos -->
	<span class="bem-vindo">
	<?php 
		echo ($idDaSessao<>$idExtrangeiro) ? 'Amigos de '.$user_nome.' '.$user_sobrenome.' ( '.$numamigos.' )' : 
		'Meus Amigos ('.$albuns['num'].')';
	?> 
	</span>
    <br>
    <div id="content-resultado-amigos-pagina">
<!--<li class="amigosli"><a href="perfil.php?uid='.$resAmigos[0].' "><img class="amigosimg"  src="uploads/user/'.$imagemamigo.'" alt=""/ title="'.$resAmigos[1].' '.$resAmigos[2].'" /></a></li> -->
	<ul class="amigos-ul-todos">
		<center>
			<?php
				if($numamigos>0){

					while ($resAmigos= $selamigos->fetch(PDO::FETCH_NUM)) {
						$relacionamento = $resAmigos[6];
						$idade = $resAmigos[5];			

						//Relacionamento
						if($relacionamento == 0){
							$relaciona = 'Não Informado';
						}else if($relacionamento == 1){
							$relaciona = 'Solteiro(a)';
						}else if($relacionamento == 2){
							$relaciona = 'Relacionamento Serio';
						}else if($relacionamento == 3){
							$relaciona = 'Casado(a)';
						}else{
							$relaciona = 'Error x0000002B';
						}



						//Calcular idade			

						date_default_timezone_set('America/Sao_Paulo');				
						$hoje = date ('Y');		
						$totalIdade =  $hoje - $idade;
						/* Pega a foto de perfil do usuario ou se ele não tiver coloca a padrão */
						$imagemamigo = (file_exists('uploads/user/'.$resAmigos[3])) ? $resAmigos[3] : 'default_mas.png';
						/* Exibi os Amigos */
						echo '<li>
								<div id="content-resultado-pagina">				
									<br>
									<div id="busc-capa">
										<img src="uploads/capa/'.$resAmigos[4] .'" width="200" height="230" /> 
									</div>
									<div id="busc-foto-pagina-amigos">
										<img src="uploads/user/'.$imagemamigo.'" width="120" height="130" />
									</div>
									<div id="busc-inf-pagina-amigos">
										<center>
											<span class="busc-usu-nome">'.$resAmigos[1].' '.$resAmigos[2].'</span><br>
											<span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
													<circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
												'.$totalIdade.' anos
											</span>
										</center>
									</div>
								</div>
								</li>';
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
   