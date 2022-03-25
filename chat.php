		<span class="user_onlines" id="<?php echo $_SESSION['socialisee_uid']; ?>"></span>
		<aside id="user-online">
			<ul>
			<?php
				date_default_timezone_set('America/Sao_Paulo');
				$pegaUsuarios = DB::getConn()->prepare("SELECT usuario.id, usuario.nome, usuario.sobrenome, usuario.img, usuario.limite FROM usuario INNER JOIN amizade  ON (((usuario.id=amizade.de) AND (amizade.para=?)) OR ((usuario.id=amizade.para) AND (amizade.de=?))) AND amizade.status=1");
  				$pegaUsuarios->execute(array($_SESSION['socialisee_uid'],$_SESSION['socialisee_uid']));
				if($pegaUsuarios->rowCount() == 0){
					echo '<p class="sem-amigos-chat">Desculpe, não encontramos amigos adicionado.</p>';
				}else{
					while($usuario = $pegaUsuarios->fetchObject()){
						$agora = date('Y-m-d H:i:s');
						$status = 'on';
						if($agora >= $usuario->limite){
							$status = 'off';
					}
			?>
				<!--<li id="<?php echo $_SESSION['socialisee_uid']; ?>">-->
					<li id="<?php echo $usuario->id; ?>">
					<div class="imgPequena"><img src="uploads/user/<?php echo $usuario->img; ?>" /></div>
					<a href="#" id="<?php echo $_SESSION['socialisee_uid'].':'.$usuario->id; ?>" class="comecar"><?php echo $usuario->nome." ".$usuario->sobrenome; ?></a>
					<span id="<?php echo $usuario->id; ?>" class="status <?php echo $status; ?>"></span>
				</li>
				<?php }} ?>				
			</ul>
		</aside>
		<aside id="chats">			
			
			
		</aside>
