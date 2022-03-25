<?php
	include('header.php');

	$e_meu_amigo = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE para=? AND `status`=0 ');
    $e_meu_amigo->execute(array($idExtrangeiro));
	$quantidade = $e_meu_amigo->rowcount();

?>
 
	
<div id="content-solicita-pagina">
	<?php
		include('paginas/menuEsquerda.php');
	?>
	<div id="centro-content-solicita-pagina">
		<ul>
			<li>
			<br>

				<span id="soli-mensagem-pagina">Você tem <?php echo $quantidade; ?> pedidos de Amizade Pendentes !</span>
			<?php
									    
		        if ($e_meu_amigo->rowcount()>0) {
		            echo '<ul>';
		            while($resmeuamigo=$e_meu_amigo->fetch(PDO::FETCH_ASSOC)){		
		            	$dadosamizade = DB::getConn()->prepare("SELECT `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
		                $dadosamizade->execute(array($resmeuamigo['de']));
		                $dadosamizade = $dadosamizade->fetch(PDO::FETCH_ASSOC);		                            
		                $asstatusamizade ['nome'] = $user_nome;
		                $asstatusamizade ['sobrenome'] = $user_sobrenome;
						$asstatusamizade ['img'] = $user_img;
						$relacionamento = $dadosamizade['relacionamento'];
						$idade = $dadosamizade['ano'];			

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

		                echo '<li>
		                	<div id="content-solicita">				
								<br>
								<div id="busc-capa">
									<img src="uploads/capa/'.$dadosamizade ['capa'].'" width="200" height="230" /> 
								</div>
								<div id="busc-foto">
									<img src="uploads/user/'.$dadosamizade ['img'].'" width="120" height="130" />
								</div>
								<div id="busc-inf"><center><span class="busc-usu-nome">'.$dadosamizade['nome'].' '.$dadosamizade['sobrenome'].'  </span><br>
									<span class="busc-usu-inf">'.$relaciona.'
								 	<svg height="10" width="10">
									  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
									</svg>
								'.$totalIdade.'</span></center></div>
								<div id="botoes-align-solicita-pagina">
									<a href="paginas/amizade.php?ac=aceitar&id='.$resmeuamigo['id'].'" class="btn-aceita-soli-pagina">
										<img src="img/aceitarSolicitacao.png">
									</a>
									<a class="btn-recusa-soli-pagina" href="paginas/amizade.php?ac=remover&id='.$resmeuamigo['id'].'&de='.$resmeuamigo['de'].'&para='.$idDaSessao.'">
										<img src="img/recusarSolicitacao.png">
									</a>
								</div>
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
		</ul>
	</div>
</div>


<?php
	include('footer.php');
?>