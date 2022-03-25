<?php
	include_once "conexao.php";
	$get = strip_tags($_GET['q']);

	$string = sprintf("SELECT u.id, u.nome, u.sobrenome, u.ano, u.sexo, u.img, u.relacionamento, u.pesq, c.nome cidade FROM usuario u 
		               inner join cidade c on c.id = u.cidade 
		               WHERE u.nome LIKE '%%%s%%' AND u.pesq = 1
		               OR u.sobrenome LIKE '%%%s%%' AND u.pesq = 1  ", $get, $get);
	$executar = mysql_query($string);
	



	if(mysql_num_rows($executar) == 0){
		echo '<p>Não foram encontrados resultados</p>';
	}else{
		$num = mysql_num_rows($executar);

			echo '<ul>';
			while($res = mysql_fetch_object($executar)){

			//Calcular idade				
				$idade = $res->ano;
				date_default_timezone_set('America/Sao_Paulo');				
				$hoje = date ('Y');		
				$totalIdade =  $hoje - $idade;
			//Relacionamento
				if($res->relacionamento == 0){
					$relaciona = 'Não Informado';
				}else if($res->relacionamento == 1){
					$relaciona = 'Solteiro';
				}else if($res->relacionamento == 2){
					$relaciona = 'Relacionamento Serio';
				}else if($res->relacionamento == 3){
					$relaciona = 'Casado';
				}else{
					$relaciona = 'Error x0000001B';
				}
			//Imagem
				$fotoBusca = $res->img;
				if($fotoBusca == ''){
					$fotoBusca = 'default.png';
				}else{
					$fotoBusca = $res->img;
				}
?>
	<li>
		<a href="perfil.php?uid=<?php echo $res->id; ?>" class="link-perfil-topo">
			<img src="uploads/user/<?php echo $fotoBusca; ?>" width="50px" height="50px;">
			<span class="nome-pesq-topo"><?php echo $res->nome . ' '. $res->sobrenome; ?></span><br>
			<span class="inf-pesq-topo"><?php echo $res->cidade; ?> - <?php echo $relaciona; ?> - <?php echo $totalIdade; ?> anos</span>
		</a>
	</li>
	<center>
		<hr width="95%" size="1px" color="#EEEEEE" />
	</center>
<?php
			}
			echo '</ul>';
			$num = mysql_num_rows($executar);
			if($num >= '5'){
				?>
					<script type="text/javascript">
						$("#resultado-pesquisa-topo-exibir").removeClass("resu-desativado");
						$("#resultado-pesquisa-topo-exibir").addClass("resu-ativo");
					</script>
				<?php
			}else if($num <4){
				?>
					<script type="text/javascript">
						$("#resultado-pesquisa-topo-exibir").removeClass("resu-ativo");
						$("#resultado-pesquisa-topo-exibir").addClass("resu-desativado");
					</script>
				<?php
			}
			
	}
?>