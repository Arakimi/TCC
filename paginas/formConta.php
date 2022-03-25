<script type="text/javascript">
	function placeOrder(form){ 
    form.submit();
}	
</script>
<form method="POST" enctype="multipart/form-data" name="update-config-pessoal" action="paginas/updateConta.php">			
	<div id="left-configuracoes-conta">
		<ul>		
			<li><span class="txtcampo">Email:</span></li><br>
			<li><span class="txtcampo">Senha Antiga:</span></li><br>
			<li><span class="txtcampo">Nova Senha:</span></li><br>
			<li><span class="txtcampo">Confirmar Nova Senha:</span></li><br>
    	</ul>
	</div>
	<div id="right-configuracoes-conta">
		<ul>						
			<li>
				<input type="text" disabled="" value="<?php echo $confResu[16]; ?>" class="dig-campo">
			</li><br>
			<li>
				<input type="password" name="senhaAntiga" placeholder="Senha Antiga" class="dig-campo">
				<span class="inf-atualiza">Senha de Acesso atual.</span>
			</li><br>
			<li>
				<input type="password" name="senhaNova" placeholder="Nova Senha" class="dig-campo">
				<span class="inf-atualiza">A senha deve conter de 8 a 32 caracteres !</span>
			</li><br>
			<li>
				<input type="password" name="senhaNovaConfirma" placeholder="Confirma Nova Senha" class="dig-campo">
				<span class="inf-atualiza">Confirme a senha digitada no campo acima.</span>
			</li><br>
			<li>
				<input type="text" name="idUser" hidden value="<?php echo $idDaSessao; ?>">
				<input type="submit" class="btn-atualiza" value="Atualizar Conta" onClick="placeOrder(this.form)">
			</li>
		</ul>					
	</div>
</form> 