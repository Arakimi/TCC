<?php
	//Conexão 
	include('classes/DB.class.php');
	session_start();

	//Conexao com banco sistema de busca de cidade por estado
	include('buscar/est_cid/conexao.php');
	$sql = "SELECT * FROM estado ORDER BY nome";
	$res = mysql_query($sql, $conexao);
	$num = mysql_num_rows($res);
	
	for ($i = 0; $i < $num; $i++) {
		$dados = mysql_fetch_array($res);
		$arrEstados[$dados['est_id']] = utf8_encode($dados['nome']);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Skoo - Cadastre-se</title>
		<link rel="stylesheet" type="text/css" href="css/padrao.css">
		<meta charset="utf-8" />
  	
	</head>
	<body>
	<center>
			
			<form id="form-cadastro" method="POST" enctype="multipart/form-data" name="formulario">			
				
				<ul id="progress">
					<li class="ativo">Informações de Registro</li>
					<li>Dados pessoais</li>
					<li>Configurações de Privacidade</li>
				</ul> 
				
				<!-- Primeiro Estagio  -->
				<fieldset>
				<br>					 
					<h2>Informações de Registro</h2><br>
					<div id="resp"></div>
					<?php
						date_default_timezone_set('America/Sao_Paulo');
						$data = date('Y-m-d');
						if(isset($_SERVER['REQUEST_METHOD']) AND $_SERVER['REQUEST_METHOD'] == 'POST'){
							extract($_POST);
							
							echo '<h3><div id="errorCad"><br>';
							/*Verifica se o campo não esta em branco*/
							if($nome == '' OR strlen($nome)<3){
								echo 'Escreva seu nome corretamente ';
							}elseif($sobrenome=='' OR strlen($sobrenome)<5){
								echo 'Escreva seu sobrenome corretamente ';
							}elseif($email=='' OR strlen($email)<10){
								echo 'Escreva seu e-mail corretamente ';
							}					
							try{			
								$verificar = DB::getConn()->prepare("SELECT `id` FROM `usuario` WHERE `email` =?"); /*Verifica se o e-mail já xiste no banco*/
								if($verificar->execute(array($email))){
									if($verificar->rowCount()>=1){
										echo 'Este e-mail já esta sendo ultilizado ';
									}elseif($senha == '' OR strlen($senha)<=3){
										echo 'Sua senha deve contem mais de 3 caracteres '; /*Verifica se a senha contem mais de 6 caracteres*/
									}elseif($senha != $senha2){
										echo "As senhas digitadas não conferem "; /*Verifica se as senhas do campo 1 e 2 são iguais*/
									}else{
										$senhaInsert = hash('sha512', $senha); /*Faz a 1° criptografia da senha*/								
										$nascimento = "$mes$dia"; /*Pega o dia mes a ano e coloca em uma variavel*/
										$inserir = DB::getConn()->prepare("INSERT INTO `usuario` SET `nome`=?, `sobrenome`=?, `ano`=?, `nascimento`=?, `sexo`=?, `pais`=?, `estado`=?, `cidade`=?, `email`=?, `senha`=?, `relacionamento`=?, `ddd`=?, `celular`=?, `cabelo`=?, `olhos`=?, `pesq`=?, `vcelular`=?, `cadastro`=? "); /*Prepara os arquivos para mandar pro banco*/
										if($inserir->execute(array($nome, $sobrenome, $ano, $nascimento, $sexo, $pais, $estado, $cidade, $email, $senhaInsert, $relacionamento, $ddd1, $celular, $cabelo, $olhos, $pesq, $vcelular, $data))){
												echo '<script>window.location="./";</script>';
										}
									}
								}
							}catch(PDOException $e){
								echo 'Sistema indisponível'; /*Se der qualquer erro mostra essa mensagem para o usuario*/
								/*echo 'alert ("print_r($inserir->errorInfo())");'; /*USADO PARA TESTAR ERROS */
								logErros($e);
							}
							echo '</h3></div><br>';
						}
					
					?>				
									
					<input type="text" name="email" placeholder="Email" class="cad"><br>
					<input type="password" name="senha" placeholder="Senha" class="cad"><br>
					<input type="password" name="senha2" placeholder="Confirmar senha" class="cad"><br>
					<input type="text" name="ddd1" class="ddd" placeholder="DDD" maxlength="3">
					<input type="text" name="celular" class="cel" placeholder="Celular" maxlength="9"><br>
					<select name="pais" class="cad" >
					<option value="Brasil">Brasil</option>
					</select><br>
					<select name="estado" id="estado" onchange="buscar_cidades()" class="cad">
		        		<option value="">Estado</option>
		        			<?php foreach ($arrEstados as $value => $name) {
		          				echo "<option value='{$value}'>{$name}</option>";
		       				}?>
		     		</select><br>	            
		            <div id="load_cidades">
		               	<select name="cidade" id="cidade" class="cad">
		          			<option value="">Selecione o estado</option>
		       			</select><br>
		            </div>					
					<input type="button" name="next1" class=" btnnext next acao" value="Proximo">									
				</fieldset>

				<!-- Segundo Estagio -->
				<fieldset>
				<br>
					<h2>Dados Pessoais</h2><br>
					<input type="text" name="nome" placeholder="Nome" class="cad"><br>
					<input type="text" name="sobrenome" placeholder="Sobrenome" class="cad"><br>
					<select name="sexo" class="cad">						
						<option <?php if(isset($sexo) AND $sexo == 'Não Informar') echo 'selected="selected"'; ?> value="Não Informar">Não Informar</option>
						<option <?php if(isset($sexo) AND $sexo == 'masculino') echo 'selected="selected"'; ?> value="Masculino">Masculino</option>
						<option <?php if(isset($sexo) AND $sexo == 'feminino') echo 'selected="selected"'; ?> value="Feminino">Feminino</option>
						<option <?php if(isset($sexo) AND $sexo == 'outros') echo 'selected="selected"'; ?> value="Outros">Outros</option>
						
                	</select><br>
					<select name="dia" class="secnas selectnas ani">
            			<?php
							for($d=1;$d<32;$d++){
								$zero = ($d<10) ? 0 : '';
								echo'<option value="',$zero,$d,'">',$zero,$d,'</option>';
							}
						?>      
					</select>
					<select name="mes" class="secnas selectnas ani">
		            	<?php
							$meses = array('','Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
							for($m=1;$m<=12;$m++){
								$zero = ($m<10) ? 0 : ''; 
								echo '<option value="',$zero,$m,'">',$meses[$m],'</option>';
							}
						?>
					</select>
					<select name="ano" class="secnas selectnas ani">
		           		<?php
							for($a=date('Y');$a>=(date('Y')-100);$a--){
								echo '<option value="',$a,'">',$a,'</option>';
							}
						?> 
					</select><br>
					<select name="relacionamento" class="cad">
					<option <?php if(isset($relacionamento) AND $relacionamento == 'Selecione uma Opção de Relacionamento') echo 'selected="selected"'; ?> value="">Selecione uma Opção de Relacionamento</option>
						<option <?php if(isset($relacionamento) AND $relacionamento == 'Não Informar') echo 'selected="selected"'; ?> value="0">Não Informar</option>
						<option <?php if(isset($relacionamento) AND $relacionamento == 'Solteiro') echo 'selected="selected"'; ?> value="1">Solteiro</option>
						<option <?php if(isset($$relacionamento) AND $relacionamento == 'Relacionamento Serio') echo 'selected="selected"'; ?> value="2">Relacionamento Serio</option>
						<option <?php if(isset($$relacionamento) AND $relacionamento == 'Casado') echo 'selected="selected"'; ?> value="3">Casado</option>
                	</select><br>
                	<select name="cabelo" class="cad">
                		<option <?php if(isset($cabelo) AND $cabelo == 'Selecione a cor do seu cabelo') echo 'selected="selected"'; ?> value="">Selecione a cor do seu cabelo</option>
						<option <?php if(isset($cabelo) AND $cabelo == 'Não Informado') echo 'selected="selected"'; ?> value="0">Não Informar</option>
						<option <?php if(isset($cabelo) AND $cabelo == 'Preto') echo 'selected="selected"'; ?> value="1">Preto</option>
						<option <?php if(isset($cabelo) AND $cabelo == 'Castanho') echo 'selected="selected"'; ?> value="2">Castanho</option>
						<option <?php if(isset($cabelo) AND $cabelo == 'Loiro') echo 'selected="selected"'; ?> value="3">Loiro</option>
						<option <?php if(isset($cabelo) AND $cabelo == 'Ruivo') echo 'selected="selected"'; ?> value="4">Ruivo</option>	
						<option <?php if(isset($cabelo) AND $cabelo == 'Outros') echo 'selected="selected"'; ?> value="5">Outros</option>
                	</select><br>
                	<select name="olhos" class="cad">
                		<option <?php if(isset($olhos) AND $olhos == 'Selecione a cor do seu Olho') echo 'selected="selected"'; ?> value="">Selecione a cor do seu Olho</option>
						<option <?php if(isset($olhos) AND $olhos == 'Não Informado') echo 'selected="selected"'; ?> value="0">Não Informar</option>
						<option <?php if(isset($olhos) AND $olhos == 'Preto') echo 'selected="selected"'; ?> value="1">Preto</option>
						<option <?php if(isset($olhos) AND $olhos == 'Castanho') echo 'selected="selected"'; ?> value="2">Castanho</option>
						<option <?php if(isset($olhos) AND $olhos == 'Azul') echo 'selected="selected"'; ?> value="3">Azul</option>
						<option <?php if(isset($olhos) AND $olhos == 'Verde') echo 'selected="selected"'; ?> value="4">Verde</option>
						<option <?php if(isset($olhos) AND $olhos == 'Outros') echo 'selected="selected"'; ?> value="5">Outros</option>
                	</select><br>
                	<input type="button" name="next2" class="btnnext next acao" value="Proximo"><br>   	
					<input type="button" name="prev" class="btnprev prev acao" value="Anterior">									
				</fieldset>
				<!-- Terceiro Estagio  -->				
				<fieldset>
				<br>
					<h2>Configuração de Privacidade</h2><br>
					<span>Quem pode te procurar ?</span><br>
					<input type="radio" name="pesq" value="1" checked> Todos
  					<input type="radio" name="pesq" value="0"> Ninguem<br><br>  					
  					<span>Quem pode ver meu numero de celular ?</span><br>
					<input type="radio" name="vcelular" value="1" checked> Todos
					<input type="radio" name="vcelular" value="2" > Amigos
  					<input type="radio" name="vcelular" value="0"> Ninguem<br>
  					<button type="submit" name="cadastro" class="btnnext acao" value="Cadastrar" onClick="placeOrder(this.form)">Cadastrar</button>
  					<input type="button" name="prev" class="btnprev prev acao" value="Anterior">			
				</fieldset>			
		</form>
		<div id="jaCadastrado"><a href="index.php" >Já tem cadastro ? faça login clicando aqui !</a></div>
	</center>
		<script src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/functions.js"></script>
		<script type="text/javascript">
			function placeOrder(form){
		    form.submit();
		}	
		</script>
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
	</body>
</html>