<?php
	require_once('classes/DB.class.php');
	require_once('classes/Login.class.php');
	require_once('classes/Recados.class.php');
	require_once('classes/Amizade.class.php');
	require_once('classes/Allbuns.class.php');
	$objLogin = new Login;

	 

	/*VERIFICA SE ESTA LOGADO*/
	if(!$objLogin->logado()){
		include('login.php');
		exit();
	}
	
	/*BOTÃO SAIR*/
	if(isset($_GET['sair'])){
		if(true == $_GET['sair']){
			$objLogin->sair();
			header("Location: ./");

		}
	}

	$idExtrangeiro = (isset($_GET['uid'])) ? $_GET['uid'] : $_SESSION['socialisee_uid'];
	$idDaSessao = $_SESSION['socialisee_uid'];
	
	/*PEGA OS DADOS DO BANCO*/
	$dados = $objLogin->getDados($idExtrangeiro);
	
	if(is_null($dados)){
		header('Location: ./');
		exit();
	}else{
		extract($dados,EXTR_PREFIX_ALL,'user');
	}
		$list_amigos = Amizade::list_amigos($idExtrangeiro); 
        $albuns = Albuns::listAlbuns($idExtrangeiro);

    /*ALTERA O HORARIO E O LIMITE DO USUARIO NO CHAT*/
    $agora = date('Y-m-d H:i:s');
	$limite = date('Y-m-d H:i:s' , strtotime('+ 2 min'));
	$id = $_SESSION['socialisee_uid'];
	$update = DB::getConn()->prepare("UPDATE `usuario` SET `horario` = ?, `limite` = ? WHERE `id`= ?");
	$update->execute(array($agora, $limite, $id));

	$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? AND `status`=0 ');
    $e_meu_amigo->execute(array($idDaSessao));
	$quantidade = $e_meu_amigo->rowcount();
				
 	$meus_dados = DB::getConn()->prepare('SELECT `nome`, `sobrenome`, `img` FROM `usuario` WHERE `id`=? ');
 	$meus_dados->execute(array($idDaSessao));
 	$exibe_meus_dados = $meus_dados->fetch(PDO::FETCH_ASSOC);

	/* PEGA DADOS PARA MODAL DENUNCIA PERFIL */
	$infExtrangeiro = DB::getConn()->prepare("SELECT `nome`, `sobrenome`, `img` FROM usuario WHERE `id`=?");
	$infExtrangeiro->execute(array($idExtrangeiro));
	$resuExtrangeiro  = $infExtrangeiro->fetch(PDO::FETCH_ASSOC);;


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Skoo - Seja Bem Vindo</title>
		<link rel="stylesheet" type="text/css" href="css/<?php echo $user_tema; ?>">	
		<meta charset="UTF-8"/>		
	</head>
	<body>
	<?php
		include ('chat.php');
	?>	
	<!-- INICIO MODAL PRIVACIDADE -->
	<div id="bg-modal-privacidade"></div>
	<div class="modal-box-privacidade">
		<div id="content-modal-privacidade">
			<div id="content-modal-privacidade">
				<span class="mensagem-privacidade-modal">Termo de uso simplificado</span>
				<div id="content-texto-modal-privacidade">					
					<span class="termos-linha">
						- Para proteger sua experiência e a segurança das pessoas que utilizam a Skoo, há algumas restrições quanto ao tipo de conteúdo e comportamento que permitimos. 
					</span><br>
					<span class="termos-linha">
						- Os usuários devem seguir as regras definidas pelo site. A violação das regras poderá resultar em bloqueio temporário e/ou suspensão permanente da(s) conta(s).
					</span><br>
					<span class="termos-linha">
						- É proibido a utilização do site para fins ilegais.
					</span><br>
					<span class="termos-linha">
						- É proibido a utilização do nome ou logotipo ----, a menos que tenha tido autorização de um administrador do site.
					</span><br>
					<span class="termos-linha">
						- Existe a opção de desativação da conta, porém a mesma não será excluída do banco de dados da rede, ela apenas ficará oculta para os outros usuários.
					</span><br>
					<span class="termos-linha">
						- A mídia social tem como intuito ser um site divertido e amigável, afim de manter as pessoas socializadas, sendo uma rede para comunicação entre pessoas, compartilhamento de  fotos, novidades e informações, e coisas que possam ser do seu interesse, contanto que respeite as politicas de uso.
					</span><br>					
					<span class="termos-linha">
						- Não nos responsabilizamos pelo seus atos e caso sua publicação não atender as nossas exigências, você poderá ser punido ou até mesmo excluído da comunidade.
					</span><br>
					<span class="termos-linha">
						- É proibido utilizar nomes que detêm direitos legais ou marcas registradas sobre esses nomes de usuário.
					</span><br>
					<span class="termos-linha">
						- É proibido utilizar conteúdo pornográfico ou violento.
					</span><br>
					<span class="termos-linha">
						- É proibido insultar, xingar e ofender outros usuários, grupos, etnias ou religião.
					</span><br>
					<span class="termos-linha">
						- É proibido a divulgação de informações privadas de indivíduos e empresas, por exemplo, RG, CPF , número de cartões de crédito  sem a autorização do mesmo.
					</span><br>
					<span class="termos-linha">
						- É proibido a utilização da identidade de outra pessoa.
					</span><br>
					<span class="termos-linha">
						- É proibida a publicação de links com conteúdos maliciosos afim de prejudicar, danificar o computador ou expor a privacidade da pessoa.
					</span><br>
					<span class="termos-linha">
						- É proibido publicar qualquer conteúdo desagradável, ameaçador ou difamatório.
					</span><br>
					<span class="termos-linha">
						- É proibido a publicação de conteúdo ilegal que possa fomentar uma conduta que possa ser considerada uma ação criminosa. 
					</span>
				</div>
			</div>
			<a href="downloads/TERMOS_DE_USO_SKOO.docx">Download Termos de Uso Completo</a><br>
		</div>
	 	<a href="" id="close-modal-privacidade">X</a>
	</div>
	<!-- FIM MODAL PRIVACIDADE -->
	<!-- MODAL BUG -->
	<div id="bg-modal"></div>
	<div class="modal-box-bug">
		<div id="content-modal-bug">
		<?php
		
			/*ENVIAR BUG !*/

			if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['bug'])){
				extract($_POST);
				
				date_default_timezone_set('America/Sao_Paulo');

				$usuario = $idDaSessao;
				$data = date('Y-m-d');

				echo '<div id="errorEnvBug">';
				/*Verifica se o campo não esta em branco*/										
				try{		
					if($bug == '' OR strlen($bug)<3){
						echo 'Preencha o campo BUG corretamente.<br>';
					}
					if($local == ''){
						echo "Preencha o campo onde foi encontrado o erro.";
					}else{													
						$inserir = DB::getConn()->prepare("INSERT INTO `bug` SET `usuario`=?, `bug`=?, `descricao`=?, `local`=?, `data`=? "); /*Prepara os arquivos para mandar pro banco*/
						if($inserir->execute(array($usuario, $bug, $descricaoBug, $local, $data ))){
							echo '<script>alert("Obrigado por relatar o erro :)")</script>';
							echo '<script>window.location="./";</script>';
						}

					}						
				}catch(PDOException $e){
					echo 'Sistema indisponível'; /*Se der qualquer erro mostra essa mensagem para o usuario*/
					/*print_r($inserir->errorInfo()); /*USADO PARA TESTAR ERROS */
					logErros($e);
				}
				echo '</div>';
			}
			?>		
			<form method="POST" enctype="multipart/form-data" name="formulario-bug">
				<span class="mensagem-modal-bug">Nos informe pelo formulario qual o erro encontrado</span><br><br>
			 	<input type="text" name="bug" class="camp-modal-bug" placeholder="QUAL BUG ENCONTRADO ?"><br>
			 	<input type="text" name="descricaoBug" class="camp-modal-bug" placeholder="CONTE COM DETALHES OQUE FAZIA QUANDO ACONTECEU"><br>
			 	<select name="local" id="" class="select-modal-bug">
					<option value="">Informe a pagina onde estava</option>
					<option value="0">Inicial</option>
					<option value="1">Amizade</option>
					<option value="2">Fotos</option>
			    	<option value="3">Videos</option>
			    	<option value="4">Busca Topo do site</option> 
			    	<option value="5">Busca Avançada</option> 
				</select><br>
				<input type="submit" name="enviar-bug" value="Relatar Erro" class="env-bug-modal" >
			</form>
		</div>
	 	<a href="" id="close-modal-bug">X</a>
	</div>
	<!-- FIM MODAL BUG -->
	<!-- INICIO MODAL EQUIPE -->
	<div id="bg-modal-equipe"></div>
	<div class="modal-box-equipe">
		<div id="content-modal-equipe">
			<div id="content-modal-equipe">	
				<span class="mensagem-equipe-modal">Conheça a equipe por traz da Skoo</span><br>
				<div id="equipe-one-modal">
					<a href=""><img src="uploads/equipe/caio.jpg" width="100px" height="100px" />
					<span class="nome-equipe-modal">Caio Apolinario</span></a>
				</div>
				<div id="equipe-one-modal">
					<a href=""><img src="uploads/equipe/carlos.png" width="100px" height="100px" />
					<span class="nome-equipe-modal">Carlos Conti</span></a>
				</div>
				<div id="equipe-one-modal">
					<a href=""><img src="uploads/equipe/everton.jpg" width="100px" height="100px" />
					<span class="nome-equipe-modal">Everton Medeiros</span></a>
				</div>
				<div id="equipe-one-modal">
					<a href=""><img src="uploads/equipe/bruno.png" width="100px" height="100px" />
					<span class="nome-equipe-modal">Bruno Bortoletto</span></a>
				</div>				
			</div>			
		</div>		
	 	<a href="" id="close-modal-equipe">X</a>
	</div>
	<!-- FIM MODAL EQUIPE -->
	<!-- INICIO MODAL TUTORIAL -->
	<div id="bg-modal-tutorial"></div>
	<div class="modal-box-tutorial">
		<div id="content-modal-tutorial">
			<div id="content-modal-tutorial">
				<span class="mensagem-tutorial-modal">Como usar a Skoo ?</span>
			</div>
			<div id="content-tutorial-imagens">
				<div id="left-modal-tutorial">
					
				</div>
				<div id="right-modal-tutorial">
					
				</div>
			</div>
		</div>
	 	<a href="" id="close-modal-tutorial">X</a>
	</div>
	<!-- FIM MODAL TUTORIAL -->
	<!-- MODAL DENUNCIAR PERFIL -->
	<div id="bg-modal-denunciar-perfil"></div>
	<div class="modal-box-denunciar-perfil">
		<div id="content-modal-denunciar-perfil">
			<div id="content-modal-denunciar-perfil">

			<?php
			/*ENVIAR DENUNCIA PERFIL*/
				if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['txtdenuncia'])){
					extract($_POST);
					
					date_default_timezone_set('America/Sao_Paulo');		
					$data = date('Y-m-d');

					echo '<center><br><div id="errorEnvBug">';
					/*Verifica se o campo não esta em branco*/										
					try{		
						if($txtdenuncia == '' OR strlen($txtdenuncia)<3){
							echo 'Preencha o campo MOTIVO corretamente.<br>';
						}
						if($motivo == ''){
							echo "Selecione o motivo da denuncia.";
						}else{													
							$inserir = DB::getConn()->prepare("INSERT INTO `denuncia` SET `usuario`=?, `denunciado`=?, `motivo`=?, `opcao`=?, `data`=? "); /*Prepara os arquivos para mandar pro banco*/
							if($inserir->execute(array($idDaSessao, $idExtrangeiro, $txtdenuncia, $motivo, $data ))){

								$location = ($idExtrangeiro<>$idDaSessao) ? 'perfil.php?uid='.$idExtrangeiro : './';

								echo '<script>alert("Estamos verificando!")</script>';								
        						echo'<script>window.location="'.$location.'";</script>';		
							}

						}						
					}catch(PDOException $e){
						echo 'Sistema indisponível'; /*Se der qualquer erro mostra essa mensagem para o usuario*/
						/*print_r($inserir->errorInfo()); /*USADO PARA TESTAR ERROS */
						logErros($e);
					}
					echo '</div></center>';
				}
			?>
				<form method="POST" enctype="multipart/form-data" name="formulario-denuncia">
					<span class="mensagem-modal-bug">NOS INFORME O MOTIVO DA DENUNCIA</span><br><br>
					<img src="uploads/user/<?php echo $resuExtrangeiro['img']; ?>" width="150px" height="170px">
				 	<input type="text" name="txtdenuncia" class="camp-modal-denunciar" placeholder="QUAL O MOTIVO DA DENUNCIA ?"><br>
				 	<select name="motivo" class="select-modal-denunciar">
				 		<option value="">SELECIONE O MOTIVO</option>
				 		<option value="1">POSTAGEM OFENSIVA</option>
				 		<option value="2">DENUNCIAR PERFIL</option>
				 		<option value="3">DENUNCIAR ASSÉDIO</option>			 		
				 		<option value="4">OUTROS</option>
				 	</select>			 	
				 	<input type="text" name="idDenunciado" value="<?php echo $idExtrangeiro; ?>" hidden>
				 	<input type="text" name="idDenuncia" value="<?php echo $idDaSessao; ?>" hidden>
				 	<br>
				 	<input type="submit" name="enviar-bug" value="Denunciar Usuario" class="env-denuncia-modal" ><br><br>
				 	<span class="aviso-denuncia">Você esta preste a denunciar <a href="perfil.php?uid=<?php echo $idExtrangeiro?>"><?php echo $resuExtrangeiro['nome']. ' '.$resuExtrangeiro['sobrenome']; ?></a> </span>
			 	</form>
			</div>
			
		</div>
	 	<a href="" id="close-modal-denuncia-perfil">X</a>
	</div>
	<!-- FIM MODAL DENUNCIAR PERFIL -->

	<!-- MODAL TEMA -->
	<div id="bg-modal-tema"></div>
	<div class="modal-box-tema">
		<div id="content-modal-tema">
		<?php
		
			/*ENVIAR BUG !*/

			if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tema'])){
				extract($_POST);
				
				date_default_timezone_set('America/Sao_Paulo');

				$usuario = $idDaSessao;
				$data = date('Y-m-d');

				echo '<div id="errorEnvBug">';
				/*Verifica se o campo não esta em branco*/										
				try{		
					if($tema == ''){
						echo 'Selecione um tema.<br>';
					}
					else{													
						$inserir = DB::getConn()->prepare("UPDATE `usuario` SET `tema`=? WHERE `id`=? "); /*Prepara os arquivos para mandar pro banco*/
						if($inserir->execute(array($tema, $usuario))){
							echo '<script>alert("Alteração realizada com sucesso :)")</script>';
							echo '<script>window.location="./";</script>';
						}

					}						
				}catch(PDOException $e){
					echo 'Sistema indisponível'; /*Se der qualquer erro mostra essa mensagem para o usuario*/
					/*print_r($inserir->errorInfo()); /*USADO PARA TESTAR ERROS */
					logErros($e);
				}
				echo '</div>';
			}
			?>		
			<form method="POST" enctype="multipart/form-data" name="formulario-tema">
				<span class="mensagem-modal-tema">Escolha um Tema:</span><br><br>			 	
			 	<select name="tema" id="" class="select-modal-tema">
					<option value="">Escolha um Tema</option>
					<option value="style_one.css">Padrão</option>
					<option value="style_two.css">Verde</option>
					<option value="style_three.css">Rosa</option>
			    	<option value="style_four.css">Dark Skoo</option>
				</select><br>
				<input type="submit" name="enviar-bug" value="Alterar Tema" class="env-tema-modal" >
			</form>			
		</div>
	 	<a href="" id="close-modal-tema">X</a>
	</div>
	<!-- FIM MODAL TEMA -->
	<div id="barra-topo">
		<div id="topoEsquerda">
			<?php 
			
				include('buscar/topo/busca.php');
			
			?>
		</div>
		<div id="topoDireita">
			<div id="alinhaTopoDireita">
				<li><a href="./" ><img src="img/homeTopo.png" class="homeTopo"></a></li>
				<li><a href="busca-avancada.php"><img src="img/buscaTopo.png" class="buscaTopo"></a></li>
				<li><a href=""><img src="img/solicitacaoTopo.png" class="solicitaTopo"></a>								
						<?php 


								if($quantidade == 1){
									echo '<div id="inf-numero-solicitacoes-topo">'.$quantidade.'</div>';
								}else if($quantidade >= 2){
									echo '<div id="inf-numero-solicitacoes-topo">'.$quantidade.'</div>';
								}else if($quantidade >= 99){
									echo '<div id="inf-numero-solicitacoes-topo">+99</div>';
								}else if($quantidade <= 0){
									echo '';
								}

							?>
					
					<ul>
					
						<div id="pedidos-amizade-mensagem">							
							<h1><?php 
								if($quantidade == 1){
									echo 'Você tem '.$quantidade.' solicitação pendente';
								}else if($quantidade >= 2){
									echo 'Você tem '.$quantidade.' solicitações pendente';
								}else if($quantidade <= 0){
									echo 'Não ha solicitações pendentes';
								}

								?> 
							</h1>
							
						</div>									
					<ul>
						<div id="ulSolicita">							
							<li>						
								<?php

								    $e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? AND `status`=0 ');
				                    $e_meu_amigo->execute(array($idDaSessao));

				                    if ($e_meu_amigo->rowcount()>0) {
				                        echo '<ul>';
				                        while($resmeuamigo=$e_meu_amigo->fetch(PDO::FETCH_ASSOC)){		
				                        	$dadosamizade = DB::getConn()->prepare("SELECT `nome`, `sobrenome`, `img`, `relacionamento`  FROM `usuario` WHERE `id`=? LIMIT 1");
				                            $dadosamizade->execute(array($resmeuamigo['de']));
				                            $dadosamizade = $dadosamizade->fetch(PDO::FETCH_ASSOC);		                            
				                            $asstatusamizade ['nome'] = $user_nome;
				                            $asstatusamizade ['sobrenome'] = $user_sobrenome;
											$asstatusamizade ['img'] = $user_img;
											$relacionamento = $dadosamizade['relacionamento'];

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


				                            echo '<li>
												<img width="70" height="90" src="uploads/user/'.$dadosamizade ['img'].'" class="img-solicita-topo" >
												<h2 class="nome-sobrenome-solicita-topo">
												'.$dadosamizade['nome'].' '.$dadosamizade['sobrenome'].'								
												</h2>																					
												<h3 class="relacionamento-solicita-topo">
												'.$relaciona.' 
												</h3>
												<br>
												<div id="align-img-aceita-topo">
													<a href="paginas/amizade.php?ac=aceitar&id='.$resmeuamigo['id'].'">
														<img src="img/aceitarSolicitacao.png">
													</a>
													<a class="pedido-amizade-mini-recusar" href="paginas/amizade.php?ac=remover&id='.$resmeuamigo['id'].'&de='.$resmeuamigo['de'].'&para='.$idDaSessao.'">
														<img src="img/recusarSolicitacao.png">
													</a>
												</div>
											</li>';
				                        }
				                        echo '</ul>';
				                    }else if($e_meu_amigo->rowcount() == 0){
				                    	echo '<h3 class="sem-solicitacoes-pendentes-texto">NÃO HÁ SOLICITAÇÕES PENDENTES</h3>
				                    		<img class="sem-solicitacoes-pendentes-imagem" src="img/wind.png" width="100px" height="80px"/>
				                    	';
				                    }
				                ?>

							</li>
							
						</div>
						<div id="exibi-todos-topo-mensagem-div">
							<a href="solicitacao.php?uid=<?php echo $idExtrangeiro?>">Ver todas solicitações</a>
						</div>
						</ul>
					</ul>
									
				</li>
				<li><a href="" class="configuracoes-topo"><img src="img/configuracoesTopo.png" class="configTopo"></a>
					<div id="alinhaSubmenu">
						<ul>							
							<div id="ulConfig">
								<center>
									<img src="uploads/user/<?php echo $exibe_meus_dados['img']; ?>" width="65px" height="70px" class="ft-usuario-menu-topo"><br>
									<span><?php echo $exibe_meus_dados['nome']; ?></span><br>		
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
								</center>						
								<li>
									<img src="img/configTopo.png" width="15px" height="15px" class="icon-topo-menu">
									<a href="config.php?uid=<?php echo $idDaSessao?>">CONFIGURAÇÕES</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>								
								<li>
									<img src="img/privacidadeTopo.png" width="12px" height="15px" class="icon-topo-menu">
									<a href="">PRIVACIDADE</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>
									<img src="img/termoTopo.png" width="12px" height="15px" class="icon-topo-menu">
									<a href="#bg-modal-privacidade">TERMOS DE USO</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>
									<img src="img/sugestaoTopo.png" width="15px" height="15px" class="icon-topo-menu">
									<a href="#bg-modal">REPORTAR ERRO</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>								
									<img src="img/equipeTopo.png" width="15px" height="15px" class="icon-topo-menu">
									<a href="#bg-modal-equipe">EQUIPE</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>
									<img src="img/temaTopo.png" width="15px" height="15px" class="icon-topo-menu">
									<a href="#bg-modal-tema">TEMAS</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>
									<img src="img/tutorialTema.png" width="15px" height="15px" class="icon-topo-menu">
									<a href="#bg-modal-tutorial">TUTORIAL</a>
									<center>
									<hr size="1px" color="#DDDDDD" class="linha-hr-topo">
									</center>
								</li>
								<li>
									<img src="img/sairTopo.png" width="15px" height="15px" class="icon-topo-menu"> 
									<a href="?sair=true">SAIR</a>	
								</li>
							</div>
						</ul>						
					</div>
				</li>		
			</div>						
        </div>		
		<div id="topoCentro">
			<img src="img/logoWhispper.png"/>
		</div>
	</div>
	