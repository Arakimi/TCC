<!DOCTYPE html>
<html>
	<head>
		<title>Skoo - Seja bem Vindo</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="css/padrao.css">
	</head>
	<body>
		<center>			
		<div id="form-login">
			<form method="POST" enctype="multipart/form-data" action="">
				<img src="img/logo.png" class="logo-login">						
				<?php 
					if(isset($_POST['logar'])){
				
						$lembrar = isset($_POST['lembrar']) ? $_POST['lembrar'] : '';
							
						if($objLogin->logar($_POST['email'],$_POST['senha'],$lembrar)){								
								header('Location: ./');
								exit;
						}else{
							echo '<br><div id="error"><br> '.$objLogin->erro. '</div>';
						}
					}
				?>				
				<br>
					<input class="txtlogin" type="text" name="email" placeholder="Email"><br>
					<input class="txtlogin" type="password" name="senha" placeholder="Senha"><br><br>
					<input name="lembrar" type="checkbox" class="txtcheck" />
					<span class="txtch">Mantenha-me Conectado</span><br>
					<input class="btnEntrar" type="submit" name="logar" value="Entrar">		
			</form>
			<div class="clear">
			<span class="off">Não é cadastrado ? </span><span class="on"><a href="cadastrar.php">Cadastre-se aqui !</a></span>
			<span class="off"><span class="on"><a href="recuperarSenha.php"> Esqueceu a Senha ?</a></span></span>
			</div>
		</div>
		</center>
	</body>
</html>