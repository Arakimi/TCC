<script type="text/javascript">
	function placeOrder(form){ 
    form.submit();
}	
</script>
<div id="centro">
	<div class="bem-vindo">
		<?php
			date_default_timezone_set('America/Sao_Paulo');
			$hr = date(" H ");
			if($hr > 00 && $hr < 12) {
				$resp = "Bom Dia, ";
			}else if ($hr >= 12  && $hr <= 18){
				$resp = "Boa Tarde, ";
			}else{
				$resp = "Boa Noite, ";
			}
				echo $resp .$user_nome;
		?>
		
	</div>
	<br>
	<div class="deixar-postagem">		
		<?php
			include('form-recados.php');
		?>
	</div>	
								               
	<div class="postagem">
		<?php  
   			include ('exbi-line-index.php'); 
		?>
	</div>
</div>