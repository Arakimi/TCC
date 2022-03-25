<?php
	include('header.php');

	$testeGeo = DB::getConn()->prepare('SELECT * FROM usuario WHERE `id`=?');
	$testeGeo->execute(array($idDaSessao));
	$DadosGeoUser = $testeGeo->fetch(PDO::FETCH_ASSOC);	
		$latitudeSessao = $DadosGeoUser["latitude"]; //Latitude Usuario Sessao
		$longitudeSessao = $DadosGeoUser["longitude"]; //Longitude Usuario Sessao

		//echo '<script>alert("'.$latitudeSessao. ' Teste ' .$longitudeSessao.'");</script>';
	
?>
<script type="text/javascript">
	function placeOrder(form){ 
    form.submit();
}	
</script>
<?php 
	
	/* Não Editar Desta linha para baixo ("SÓ DEUS SABE COMO FUNCIONA") */
	function distancia($lat1, $lon1, $lat2, $lon2) {

		$lat1 = deg2rad($lat1); 
		$lat2 = deg2rad($lat2);
		$lon1 = deg2rad($lon1);
		$lon2 = deg2rad($lon2);

		/* deg2rad() converte number de graus ao equivalente em radianos. */
		/* cos() retorna o coseno */
		/* acos() retorna o inverso do cosseno */
		/* sin() retorna o seno do parâmetro*/
		/* number_format() retorna uma versão formatada de number. Esta função aceita um, dois ou quatro parâmetros (não três)*/


		$dist = (6371 * acos( cos( $lat1 ) * cos( $lat2 ) * cos( $lon2 - $lon1 ) + sin( $lat1 ) * sin($lat2) ) );
		$dist = number_format($dist, 3, '.', '');
		return $dist;		
	/* FIM DA GEOLOCALIZAÇÃO */
}

	
?>
	
	<div id="align-menu-esquerda-busca-avancada">
	<?php
		include('paginas/menuEsquerda.php');
	?>
		<form method="POST" name="form" enctype="multipart/form-data">
			<div id="busca-por">
				<div id="left-buscar-por">
					<span class="Informa-busca-avancada">Distancia:</span><br>
			    	<span class="Informa-busca-avancada">Cabelo:</span><br>
			    	<span class="Informa-busca-avancada">Olhos:</span><br>
			    	<span class="Informa-busca-avancada">Sexo:</span><br>
			    	<span class="Informa-busca-avancada">Idade de</span><br>
				</div>
				<div id="right-buscar-por">
					<select class="campo-busca" name="buscarKM" >			    
						<option value="">Escolha uma Distancia</option>
						<option value="0.005">5 Metros</option>
			    		<option value="0.010">10 Metros</option>
			    		<option value="0.020">20 Metros</option>
			    		<option value="0.030">30 Metros</option>
			        	<option value="0.040">40 Metros</option> 
			        	<option value="0.050">50 Metros</option> 
			        	<option value="0.100">100 Metros</option> 
			        	<option value="0.200">200 Metros</option> 
			        	<option value="0.500">500 Metros</option> 
			        	<option value="1.000">1 Quilometro</option>
			        	<option value="2.000">2 Quilometros</option>
			        	<option value="4.000">4 Quilometros</option>
			        	<option value="8.000">8 Quilometros</option>
			        	<option value="15.000">15 Quilometros</option>
			        	<option value="30.000">30 Quilometros</option>
			        	<option value="60.000">60 Quilometros</option>
			        	<option value="100.000">100 Quilometros</option>
			        	<option value="200.000">200 Quilometros</option>
			        	<option value="300.000">300 Quilometros</option>
			        	<option value="400.000">400 Quilometros</option>
			        	<option value="500.000">500 Quilometros</option>
			    	</select><span class="informa-campo-necessario">* Para usar você deve AUTORIZAR a GeoLocalização em seu navegador e Configurações !</span><br>
			    	<select class="campo-busca" name="belo">	
		    			<option value="">Escolha uma cor de Cabelo</option>
						<option value="1">Preto</option>
						<option value="2">Castanho</option>
						<option value="3">Loiro</option>
						<option value="4">Ruivo</option>
						<option value="5">Outros</option>
			    	</select><span class="informa-campo-necessario">* Para usar esse campo você deve informar a sua cor de CABELO !</span><br>
			    	<select class="campo-busca" name="olho" >    		    			
			    		<option value="">Escolha uma cor de olho</option>
						<option value="1">Preto</option>
						<option value="2">Castanho</option>
						<option value="3">Azul</option>
						<option value="4">Verde</option>
						<option value="5">Outros</option>
			    	</select><span class="informa-campo-necessario">* Para usar esse campo você deve informar a sua cor de OLHO !</span><br>
			    	<select name="buscarPor" class="campo-busca">			    		    		
			        	<option value="">Escolha um sexo</option>
						<option value="Masculino">Homens</option>
						<option value="Feminino">Mulheres</option>			    	
			    	</select><br>
			    	  <input type="number" max="99" min="10" maxlength="2" name="anosMinimo" class="anos-busca" placeholder="01"> 
			    	  <span class="Informa-busca-avancada"> até </span>
			    	  <input type="number" max="99" min="10"  maxlength="2" name="anosMaximo" class="anos-busca" placeholder=" 99" >
			    	  <span class="Informa-busca-avancada"> anos</span><span class="informa-campo-necessario">* Para usar coloque uma idade minima e idade maxima!</span><br>
			    	  <input type="submit" name="enviar" value="Buscar" class="btn-buscar-avancada" onClick="placeOrder(this.form)">
				</div>
				<div id="links-uteis-busca">
					<span class="como-atualiza-busca-avancada"><a href="config.php?uid=<?php echo $idDaSessao; ?>">Clique aqui para selecionar a cor de seu olho e cabelo.</a></span>
					<span class="como-atualiza-busca-avancada"><a href="">Clique aqui para autorizar a SKOO a te encontrar.</a></span>
				<div>
			</div>
		</form>
		<br>
		<div id="busc-resultado">

			<?php 


				if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
					extract($_POST);

					include_once('classes/DB.class.php');					

					//IF 5 CAMPOS
					//SE CABELO,  OLHO, SEXO E IDADE ESTIVER PREENCHIDA
					if($buscarPor != '' && $belo != '' && $olho != '' && $buscarPor != '' && $anosMinimo != '' OR $buscarPor != '' && $belo != '' && $olho && $buscarPor != '' && $anosMaximo != '' OR $buscarPor != '' && $belo != '' && $olho != '' && $buscarPor != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $olho, $buscarPor));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , SEXO , OLHO , IDADE , DISTANCIA PREENCHIDO





					//IF 4 CAMPOS
					//SE CABELO,  OLHO, SEXO E IDADE ESTIVER PREENCHIDA
					else if($belo != '' && $olho != '' && $buscarPor != '' && $anosMinimo != '' OR $belo != '' && $olho && $buscarPor != '' && $anosMaximo != '' OR $belo != '' && $olho != '' && $buscarPor != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $olho, $buscarPor));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO E IDADE PREENCHIDO



					//IF OLHO , SEXO , IDADE E DISTANCIA
					else if($olho && $buscarPor && $buscarKM != '' && $anosMinimo != '' OR $olho && $buscarPor && $buscarKM && $anosMaximo != '' OR $olho && $buscarPor && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($olho, $buscarPor));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO , SEXO , IDADE E DISTANCIA PREENCHIDA



					//IF CABELO , SEXO , IDADE E DISTANCIA
					else if($belo && $buscarPor && $buscarKM != '' && $anosMinimo != '' OR $belo && $buscarPor && $buscarKM && $anosMaximo != '' OR $belo && $buscarPor && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $buscarPor));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , SEXO , IDADE E DISTANCIA PREENCHIDA


					//IF CABELO , OLHO , IDADE E DISTANCIA
					else if($belo && $olho && $buscarKM != '' && $anosMinimo != '' OR $belo && $olho && $buscarKM && $anosMaximo != '' OR $belo && $olho && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=?');
						$buscainf->execute(array($belo, $olho));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , SEXO , IDADE E DISTANCIA PREENCHIDA



					//IF 3 CAMPOS
					//SE CABELO , OLHO E SEXO ESTIVER PREENCHIDA
					else if($belo != '' && $olho != '' && $buscarPor != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $olho, $buscarPor));						
						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , OLHOS E SEXO PREENCHIDO



					//SE CABELO , SEXO E IDADE ESTIVER PREENCHIDA
					else if($belo != '' && $buscarPor != '' && $anosMinimo != '' OR $belo && $buscarPor != '' && $anosMaximo != '' OR $belo != '' && $buscarPor != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $buscarPor));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO E IDADE PREENCHIDO

					//SE OLHO , SEXO E IDADE ESTIVER PREENCHIDA
					else if($olho != '' && $buscarPor != '' && $anosMinimo != '' OR $olho && $buscarPor != '' && $anosMaximo != '' OR $olho != '' && $buscarPor != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($olho, $buscarPor));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO E IDADE PREENCHIDO
					

					//IF OLHO , IDADE E DISTANCIA
					else if($olho && $buscarKM != '' && $anosMinimo != '' OR $olho && $buscarKM && $anosMaximo != '' OR $olho && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=?');
						$buscainf->execute(array($olho));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO , IDADE E DISTANCIA PREENCHIDA



					//IF CABELO , IDADE E DISTANCIA
					else if($belo && $buscarKM != '' && $anosMinimo != '' OR $belo && $buscarKM && $anosMaximo != '' OR $belo && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=?');
						$buscainf->execute(array($belo));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , IDADE E DISTANCIA PREENCHIDA


					//IF SEXO , IDADE E DISTANCIA
					else if($buscarPor && $buscarKM != '' && $anosMinimo != '' OR $buscarPor && $buscarKM && $anosMaximo != '' OR $buscarPor && $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `sexo`=?');
						$buscainf->execute(array($buscarPor));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE SEXO , IDADE E DISTANCIA PREENCHIDA


					//SE OLHO , DISTANCIA E SEXO ESTIVER PREENCHIDA
					else if($olho != '' && $buscarPor != '' && $buscarKM != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($olho, $buscarPor));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE DISTANCIA E SEXO PREENCHIDO


					//SE CABELO , DISTANCIA E SEXO ESTIVER PREENCHIDA
					else if($belo != '' && $buscarPor != '' && $buscarKM != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $buscarPor));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , DISTANCIA E SEXO PREENCHIDO



					//SE CABELO , DISTANCIA E OLHO ESTIVER PREENCHIDA
					else if($belo != '' && $olho != '' && $buscarKM != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=?');
						$buscainf->execute(array($belo, $olho));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO , DISTANCIA E SEXO PREENCHIDO



					//IF 2 CAMPOS
					//SE CABELO E OLHO ESTIVER PREENCHIDA
					else if($belo != '' && $olho != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `olhos`=?');
						$buscainf->execute(array($belo, $olho));						
						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO E OLHOS PREENCHIDO

					//SE CABELO E SEXO ESTIVER PREENCHIDA
					else if($belo != '' && $buscarPor != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=? AND `sexo`=?');
						$buscainf->execute(array($belo, $buscarPor));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO E SEXO PREENCHIDO


					//SE CABELO E IDADE ESTIVER PREENCHIDA
					else if($belo != '' && $anosMinimo != '' OR $belo && $anosMaximo != '' OR $belo != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=?');
						$buscainf->execute(array($belo));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE CABELO E IDADE PREENCHIDO



					//SE SEXO E IDADE ESTIVER PREENCHIDA
					else if($buscarPor != '' && $anosMinimo != '' OR $buscarPor && $anosMaximo != '' OR $buscarPor != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `sexo`=?');
						$buscainf->execute(array($buscarPor));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE SEXO E IDADE PREENCHIDO

					//SE OLHO E SEXO ESTIVER PREENCHIDA
					else if($olho != '' && $buscarPor != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=? AND `sexo`=?');
						$buscainf->execute(array($olho, $buscarPor));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO E SEXO PREENCHIDO

					//SE OLHO E IDADE ESTIVER PREENCHIDA
					else if($olho != '' && $anosMinimo != '' OR $olho && $anosMaximo != '' OR $olho != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=?');
						$buscainf->execute(array($olho));

						

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{

								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO E IDADE PREENCHIDO

					//IF IDADE E DISTANCIA
					else if($buscarKM != '' && $anosMinimo != '' OR $buscarKM && $anosMaximo != '' OR $buscarKM != '' && $anosMinimo != '' && $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario');
						$buscainf->execute();

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];
			            	
			                $DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);
			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE IDADE E DISTANCIA PREENCHIDA



					//SE DISTANCIA E SEXO ESTIVER PREENCHIDA
					else if($buscarKM != '' && $buscarPor != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `sexo`=?');
						$buscainf->execute(array($buscarPor));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE DISTANCIA E SEXO PREENCHIDO


					//SE DISTANCIA E OLHO ESTIVER PREENCHIDA
					else if($buscarKM != '' && $olho != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`=?');
						$buscainf->execute(array($olho));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE DISTANCIA E olho PREENCHIDO



					//SE DISTANCIA E CABELO ESTIVER PREENCHIDA
					else if($buscarKM != '' && $belo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`=?');
						$buscainf->execute(array($belo));		

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];			            	
							$user_blatitude = $dadosSolicita['latitude'];
							$user_blongitude = $dadosSolicita['longitude'];

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							//Calcula Distancia
							$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

							//Calcular idade	
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE DISTANCIA E CABELO PREENCHIDO



					//IF UNICO
					//SE CABELO ESTIVER PREENCHIDA
					else if($belo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `cabelo`= ? ');
						$buscainf->execute(array($belo));										

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';

							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO PREENCHIDO

					//SE OLHO ESTIVER PREENCHIDA
					else if($olho != '' ){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `olhos`= ? ');
						$buscainf->execute(array($olho));						
						print_r($olho);
						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';

							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE OLHO PREENCHIDO


					//SE IDADE ESTIVER PREENCHIDA
					else if($anosMinimo != '' OR $anosMaximo != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario');
						$buscainf->execute();

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $totalIdade >= $anosMinimo && $totalIdade <= $anosMaximo && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE IDADE PREENCHIDA
					


					//SE SEXO ESTIVER PREENCHIDA
					else if($buscarPor != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario WHERE `sexo`=?');
						$buscainf->execute(array($buscarPor));

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			            	

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;


							if($buscainf->rowcount()>0 && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE SEXO PREENCHIDO



				//BASICO GEOLOCALIZAÇÃO
				else if($buscarKM != ''){
						$buscainf = DB::getConn()->prepare('SELECT * FROM usuario');
						$buscainf->execute();

						while($soliamigo = $buscainf->fetch(PDO::FETCH_ASSOC)){		
			            	$dadosSolicita = DB::getConn()->prepare("SELECT `id`, `nome`, `sobrenome`, `ano`,  `relacionamento`, `img`,  `capa`, `latitude`, `longitude`  FROM `usuario` WHERE `id`=? LIMIT 1");
			                $dadosSolicita->execute(array($soliamigo['id']));
			                $dadosSolicita = $dadosSolicita->fetch(PDO::FETCH_ASSOC);			                

			                //Nomeando Variaveis
			                $user_bcapa = $dadosSolicita['capa'];
			                $user_bimg = $dadosSolicita['img'];
			                $user_bnome = $dadosSolicita['nome'];
			                $user_bsobrenome = $dadosSolicita['sobrenome'];
			                $user_bid = $dadosSolicita['id'];
			                $user_brelacionamento = $dadosSolicita['relacionamento'];
			                $user_bano = $dadosSolicita['ano'];
			                $user_blatitude = $dadosSolicita['latitude'];
			                $user_blongitude = $dadosSolicita['longitude'];
			            	
			            	$DistanciaTotal = distancia($latitudeSessao, $longitudeSessao, $user_blatitude, $user_blongitude);

			            	//Verificando Relacionamento
			            	if($user_brelacionamento == 0){
								$relaciona = 'Não Informado';
							}else if($user_brelacionamento == 1){
								$relaciona = 'Solteiro(a)';
							}else if($user_brelacionamento == 2){
								$relaciona = 'Relacionamento Serio';
							}else if($user_brelacionamento == 3){
								$relaciona = 'Casado(a)';
							}else{
								$relaciona = 'Error x0000002B';
							}

							

							//Calcular idade			
							
							date_default_timezone_set('America/Sao_Paulo');				
							$hoje = date ('Y');		
							$totalIdade =  $hoje - $user_bano;

							if($buscainf->rowcount()>0 && $DistanciaTotal <= $buscarKM && $user_bid <> $idDaSessao){
								echo '<ul>
									<li>
										<div id="content-resultado">				
											<br>											
											<div id="busc-capa">
												<img src="uploads/capa/'.$user_bcapa.'" width="200" height="270" /> 
											</div>
											<div id="busc-foto">
												<a href="perfil.php?uid='.$user_bid.'">
													<img src="uploads/user/'.$user_bimg.'" width="120" height="130" />
												</a>
											</div>
											<div id="busc-inf"><center><span class="busc-usu-nome">'.$user_bnome.' '.$user_bsobrenome.'</span><br><span class="busc-usu-inf">'.$relaciona.'
											 	<svg height="10" width="10">
												  <circle cx="5" cy="5" r="2" stroke="#888888" stroke-width="3" fill="#888888" />
												</svg>
											'.$totalIdade.' anos</span></center></div>';
											if($idDaSessao<>$user_bid){
						                        $verificaAmizade = DB::getConn()->prepare('SELECT * FROM `amizade` WHERE (de=? AND para=?) OR (para=? AND de=?) LIMIT 1');
						                        $verificaAmizade->execute(array($idDaSessao,$user_bid,$idDaSessao,$user_bid));

						                        if ($verificaAmizade->rowCount() == 0) {
						                            echo '<div class="btn-solicitar-amizade">
						                            <a href="paginas/amizade.php?ac=convite&de='.$idDaSessao.'&para='.$user_bid.'">					                            	
						                            	Adicionar
						                            </a></div>';
						                            }else{
						                                $asstatusamizade = $verificaAmizade->fetch(PDO::FETCH_ASSOC);
						                            if($asstatusamizade['status'] == 0){
						                                echo '<div class="btn-solicitar-amizade">
						                                <a href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                   Cancelar Solicitação					                                        
						                                   </a></div>';
						                            }else{
						                                echo '<div class="btn-solicitar-amizade">
						                                <a  href="paginas/amizade.php?ac=remover&id='.$asstatusamizade['id'].'&de='.$idDaSessao.'&para='.$user_bid.'">
						                                	Remover amigo
						                                    	
						                                
						                                	
						                                </a>
						                                </div>';
						                            }


                      						}
                      					}
										echo '</div>
									</li>
								</ul>';
							
							}
							else{
								 
							}
							}//Fecha While
					}//FECHA IF DA VERIFICAÇÃO DE SEXO PREENCHIDO
				}//Fecha IF DO REQUEST METHOD
			?>	
		</div>
		
	
	</div>
<?php
	include('footer.php');
?>