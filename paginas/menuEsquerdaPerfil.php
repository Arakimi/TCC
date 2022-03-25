<?php

	

	//Relacionamento
	$relacionamento = $user_relacionamento;
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

	//Idade
	$idade = $user_ano;
	date_default_timezone_set('America/Sao_Paulo');				
	$hoje = date ('Y');		
	$totalIdade =  $hoje - $idade;

	//Informa Cidade
	$cidade = DB::getConn()->prepare('SELECT `nome` FROM cidade WHERE `id`=?');
	$cidade->execute(array($user_cidade));
	$cidade = $cidade->fetch(PDO::FETCH_ASSOC);

	//Estado

	$estado = DB::getConn()->prepare('SELECT `nome` FROM estado WHERE `est_id`=?');
	$estado->execute(array($user_estado));
	$estado = $estado->fetch(PDO::FETCH_ASSOC);
	$estado['nome'] = utf8_encode($estado['nome']);

?>
<div id="left-perfil">
	<div id="capa-perfil">
		<img src="./uploads/capa/<?php echo $user_capa; ?>" width="350" height="480" />
	</div>		
	<div id="foto-user-perfil">
		<img src="./uploads/user/<?php echo $user_img; ?>" width="180" height="200" />	
	</div>
	<div style="clear:both;"></div>
	<div id="info-basicas-perfil">
		<ul>
			<li>Nome: <span class="resu-inf-basicas-perfil"><?php echo $user_nome; ?></span></li>
			<li>Sobrenome: <span class="resu-inf-basicas-perfil"><?php echo $user_sobrenome; ?></span></li>
			<li>Sexo: <span class="resu-inf-basicas-perfil"><?php echo $user_sexo; ?></span></li>
			<li>Idade: <span class="resu-inf-basicas-perfil"><?php echo $totalIdade; ?></span></li>
			<li>Relacionamento: <span class="resu-inf-basicas-perfil"><?php echo $relaciona; ?></span></li>
			<li>Pais: <span class="resu-inf-basicas-perfil"><?php echo $user_pais; ?></span></li>					
			<li>Estado: <span class="resu-inf-basicas-perfil"><?php echo $estado['nome']; ?></span></li>
			<li>Cidade: <span class="resu-inf-basicas-perfil"><?php echo $cidade['nome']; ?></span></li>					
		</ul>
	</div>
		
			
	<div id="amigos-perfil">
		<?php 
		include('paginas/lista_amigos_perfil.php'); 
	?>
	</div>
	<?php
		include_once('footer.php');
	?>
	
</div>