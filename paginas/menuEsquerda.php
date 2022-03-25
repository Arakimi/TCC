<div id="esquerda">

	<div class="foto-capa">						 
   	<img src="./uploads/capa/<?php echo $user_capa; ?>" width="235" height="340" />               
	</div>
	<div class="foto-user">
		<a href="perfil.php?uid<?php echo $idExtrangeiro ?>">
			<img src="./uploads/user/<?php echo $user_img; ?>" width="140" height="160" />	
		</a>
	</div>	
	<br>
	
	<?php 
		include('menu.php');
	?>
	<span class="copy">© 2017 - Todos os direitos reservados</span>
</div>