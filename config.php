<?php 

	//Conexao com banco sistema de busca de cidade por estado
	include('buscar/est_cid/conexao.php');
	$sql = "SELECT * FROM estado ORDER BY nome";
	$res = mysql_query($sql, $conexao);
	$num = mysql_num_rows($res);
	
	for ($i = 0; $i < $num; $i++) {
		$dados = mysql_fetch_array($res);
		$arrEstados[$dados['est_id']] = utf8_encode($dados['nome']);
	}


	include('header.php');
?>
<script>
	function buscar_cidades(){
		var estado = $('#estado').val();
		if(estado){
		var url = 'buscar/est_cid/ajax_buscar_cidades.php?estado='+estado;
		$.get(url, function(dataReturn) {
			$('#load_cidades').html(dataReturn);
		});
		}
	}
</script>

	<?php

		require_once('classes/DB.class.php');

		$idDaSessao = $_SESSION['socialisee_uid'];
		

		$conf= DB::getConn()->prepare("SELECT u.id, u.nome, u.sobrenome, u.sexo, u.cabelo, u.olhos, u.relacionamento, u.estado, u.cidade, u.pais, u.ddd, u.celular, u.elocalizacao, u.pesq, u.vcelular, u.pedidosa, u.email FROM usuario u WHERE u.id=?");
		$conf->execute(array($idDaSessao));
		$confResu = $conf->fetch(PDO::FETCH_NUM);
		/*

			Arrays

			 0 id
			 1 nome
			 2 sobrenome
			 3 sexo
			 4 cabelo
			 5 olhos
			 6 relacionamento
			 7 estado
			 8 cidade
			 9 pais
			 10 ddd
			 11 celular
			
			Privacidade
			 12 localizacao
			 13 busca
			 14 celular
			 15 pedidos amizade
			
			login
			 16 email
		*/
 		


								
	?>

<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/functions.js"></script>    
<div id="corpo-configuracoes">
	<?php
		include('paginas/menuEsquerda.php');
	?>	
	<div id="content-configuracoes">		
		<br>
		<div id="menu-configuracoes">
			<li><a href="">Configurações Pessoais</a>
				<ul>
					<li id="li-pessoais">
						<div id="corpo-config">
							<div id="conf-pessoais">																	
								<!-- PESSOAIS -->
								<?php
									include_once('paginas/formPessoais.php');
								?>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li><a href="">Configurações de Privacidade</a>
				<ul>
					<li id="li-privacidade">
						<div id="corpo-config">
							<div id="conf-privacidade">									
								<!-- PRIVACIDADE -->
								<?php
									include_once('paginas/formPrivacidade.php');
								?>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li><a href="">Configurações da Conta</a>
				<ul>
					<li id="li-conta">
						<div id="corpo-config">
							<div id="conf-login">									
								<!-- CONTA -->
								<?php
									include_once('paginas/formConta.php');
								?>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li><a href="">Configurações de Localidade</a>
				<ul>
					<li id="li-local">
						<div id="corpo-config">
							<div id="conf-localizacao">								
								<!-- LOCALIDADE -->
								<?php
									include_once('paginas/formLocalidade.php');
								?>
							</div>
						</div>
					</li>
				</ul>
			</li>
		</div>
		<div id="aviso-config">
			<span class="txt-aviso">* Coloque o mouse sobre a item que deseja editar, apos alterar os dados clique no Botão Atualizar !</span>			
		</div>
	</div>
</div>
