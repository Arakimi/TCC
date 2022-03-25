<script type="text/javascript">
	function placeOrder(form){
    form.submit();
}	
</script>
<form method="POST" enctype="multipart/form-data" name="update-config-pessoal" action="paginas/updatePrivacidade.php">			
	<div id="left-configuracoes-privacidade">
		<ul>		
			<li><span class="txtcampo">Quem pode ver meu celular ?</span></li><br>
			<li><span class="txtcampo">Podemos usar sua localização na busca Avançada ?</span></li><br>
			<li><span class="txtcampo">Você deseja que o mecanismo de busca te encontre ?</span></li><br>
			<li><span class="txtcampo">Deseja receber pedidos de amizade ?</span></li><br>
    	</ul>
	</div>
	<div id="right-configuracoes-privacidade">
		<ul>						
			<li><select name="ecelular" class="select-campo">
				<option value="1"  <?php if($confResu[14] == '1'){ echo 'selected="selected"'; } ;?>>Todos</option>
				<option value="2" <?php if($confResu[14] == '2'){ echo 'selected="selected"'; } ;?> >Amigos</option>				
				<option value="0"  <?php if($confResu[14] == '0'){ echo 'selected="selected"'; } ;?> >Ninguem</option>
			</select></li><br>
			<li><select name="elocalizacao" class="select-campo">
				<option value="0" <?php if($confResu[12] == '0'){ echo 'selected="selected"'; } ;?> >Não (Você não poderá busca pessoas por perto !)</option>
				<option value="1" <?php if($confResu[12] == '1'){ echo 'selected="selected"'; } ;?> >Sim</option>					
			</select></li><br>
			<li><select name="ebusca" class="select-campo" value="<?php echo $user_olhos; ?>">
				<option value="0" <?php if($confResu[13] == '0'){ echo 'selected="selected"'; } ;?> >Não</option>
				<option value="1" <?php if($confResu[13] == '1'){ echo 'selected="selected"'; } ;?> >Sim</option>							
        	</select></li><br>
			<li><select name="ramizade" class="select-campo">
				<option value="0" <?php if($confResu[15] == '0'){ echo 'selected="selected"'; } ;?> >Não</option>
				<option value="1" <?php if($confResu[15] == '1'){ echo 'selected="selected"'; } ;?> >Sim</option>							
        	</select></li><br>						
			<li>
				<input type="text" name="idUser" hidden value="<?php echo $idDaSessao;  ?>">
				<input type="submit" class="btn-atualiza" value="Atualizar Privacidade" onClick="placeOrder(this.form)">
			</li><br>
		</ul>					
	</div>
</form> 